<?php
class ControllerToolUploadFile extends Controller {
	public function index() {
		$this->load->language('tool/upload');

		$json = array();
		$maxsize    = 200000;
		if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
			// Sanitize the filename
			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));

			// Validate the filename length
			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
				$json['error'] = $this->language->get('error_filename');
			}

			// Allowed file extension types
			$allowed = array('png','jpe','jpeg','jpg');

			/* $extension_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));

			$filetypes = explode("\n", $extension_allowed);

			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			} */

			if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
			}

			// Allowed file mime types
			$allowed = array('image/png','image/jpeg');

			/* $mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));

			$filetypes = explode("\n", $mime_allowed);

			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			} */

			if (!in_array($this->request->files['file']['type'], $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
			}

			// Check to see if any PHP files are trying to be uploaded
			$content = file_get_contents($this->request->files['file']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_filetype');
			}
			
			if(($this->request->files['file']['size'] >= $maxsize) || ($this->request->files['file']["size"] == 0)){
				$json['error'] = 'File too large. File must be less than 200kb.';
			}

			// Return any upload error
			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
			}
		} else {
			$json['error'] = $this->language->get('error_upload');
		}

		if (!$json) {
			$temp = explode(".", $filename);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			$file = $newfilename;
	
			move_uploaded_file($this->request->files['file']['tmp_name'], DIR_IMAGE . $file);
			
			// Hide the uploaded file name so people can not link to it directly.
			/* $this->load->model('tool/upload'); */

			/* $json['code'] = $this->model_tool_upload->addUpload($filename, $file); */
			
			$this->load->model('tool/image');
			$image = $this->model_tool_image->resize($file, 60, 60);
			
			$json['code'] = $file;
			$json['thumb'] = $image;

			$json['success'] = 'File successfully upload.';
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}