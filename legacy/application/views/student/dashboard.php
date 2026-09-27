<?php $this->load->view('student/header'); ?>

<style>
    :root{
  --bg1:#0f2027;
  --bg2:#203a43;
  --bg3:#2c5364;
  --glass: rgba(255,255,255,.10);
  --glass-border: rgba(255,255,255,.16);
  --accent:#ffc107;
  --text-soft: rgba(255,255,255,.78);
}
    body{
    background: linear-gradient(135deg, var(--bg1), var(--bg2), var(--bg3));
    color: #fff;
    }  
/* Page styling */
.page__heading{
  padding: 18px 0 10px;
  
}
.profile-shell{
  margin-top: 14px;
}
.card-soft{
  border: 1px solid rgba(0,0,0,.06);
  border-radius: 14px;
  box-shadow: 0 10px 25px rgba(0,0,0,.06);
}
.card-soft .card-header{
  background: #fff;
  border-bottom: 1px solid rgba(0,0,0,.06);
  border-top-left-radius: 14px;
  border-top-right-radius: 14px;
}
.badge-pill{
  border-radius: 999px;
  padding: 6px 10px;
  font-weight: 700;
  letter-spacing: .3px;
}
.badge-active{
  background: rgba(40,167,69,1);
  border: 1px solid rgba(40,167,69,.25);
  color: #FFF;
}
.badge-inactive{
  background: rgba(255,193,7,.15);
  border: 1px solid rgba(255,193,7,.30);
  color: #856404;
}
.avatar-wrap{
  width: 110px;
  height: 110px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(0,0,0,.08);
  box-shadow: 0 10px 25px rgba(0,0,0,.10);
}
.avatar-wrap img{
  width:100%;
  height:100%;
  object-fit: cover;
}
.kpi{
  display:flex;
  align-items:center;
  gap:12px;
  padding: 14px;
  border-radius: 14px;
  background: #f8f9fb;
  border: 1px solid rgba(0,0,0,.05);
}
.kpi i{
  width: 42px;
  height: 42px;
  border-radius: 14px;
  display:flex;
  align-items:center;
  justify-content:center;
  background: rgba(13,110,253,.10);
  color: #0d6efd;
}
.kpi .title{
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: .9px;
  color: #6c757d;
  margin:0;
}
.kpi .value{
  font-size: 16px;
  font-weight: 800;
  margin:0;
  color:#111;
}
.form-control[readonly]{
  background: #fff;
}
.copy-box{
  display:flex;
  gap:10px;
}
.copy-box input{
  border-radius: 10px;
}
.copy-box button{
  border-radius: 10px;
  font-weight: 700;
}
.quick-card{
  border-radius: 14px;
  border: 1px solid rgba(0,0,0,.06);
  padding: 18px;
  text-align:center;
  background: #fff;
  box-shadow: 0 10px 25px rgba(0,0,0,.06);
}
.quick-card h5{
  font-weight: 800;
  margin-bottom: 10px;
}
.quick-card p{
  color:#6c757d;
  margin-bottom: 12px;
}

</style>

<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top:60px;">
	<div class="page__heading">
		<div class="container-fluid page__container d-flex align-items-center justify-content-between">
			<h1 class="mb-0">My Profile</h1>

			<?php if($this->session->userdata('student_status')==1){ ?>
			<span class="badge badge-pill badge-active">ACTIVE</span>
			<?php } else { ?>
			<span class="badge badge-pill badge-inactive">INACTIVE</span>
			<?php } ?>
		</div>
	</div>
  
  <style>
    :root{
      --blue1:#0b2d63;
      --blue2:#0f3c86;
      --red:#c9172a;
      --text:#0f172a;
      --muted:#64748b;
      --line:#e8eef6;
      --cardRadius:18px;
    }

/*    body{ background:#f5f7fb; }*/
      
      .page__heading{
  background: none !important;
          color: #FFF;
  
}

    /* ID card canvas */
    .id-wrap{
      max-width: 420px;
      margin: 40px auto;
    }

    .id-card{
      border: 0;
      border-radius: var(--cardRadius);
      overflow: hidden;
      box-shadow: 0 18px 45px rgba(2,6,23,.12);
      background: #fff;
      position: relative;
    }

    /* Optional “plastic” border like sample */
    .id-card::before{
      content:"";
      position:absolute;
      inset:10px;
      border-radius: calc(var(--cardRadius) - 6px);
      border: 2px solid rgba(148,163,184,.35);
      pointer-events:none;
    }

    /* Top brand strip */
    .id-top{
      background: linear-gradient(135deg, var(--blue1), var(--blue2));
      color:#fff;
      padding: 16px 18px 12px;
      position: relative;
    }

    .brand{
      display:flex;
      align-items:center;
      gap:12px;
    }

    .brand .logo{
      width:46px;
      height:46px;
      border-radius:10px;
      background: rgba(255,255,255,.12);
      border: 1px solid rgba(255,255,255,.22);
      display:flex;
      align-items:center;
      justify-content:center;
      font-weight:800;
      letter-spacing:.5px;
    }

    .brand h1{
      font-size: 18px;
      line-height: 1.1;
      margin:0;
      font-weight:800;
    }

    .brand small{
      display:block;
      color: rgba(255,255,255,.85);
      font-size: 11px;
      letter-spacing: 2px;
      margin-top: 4px;
    }

    /* Red ribbon */
    .ribbon{
      background: var(--red);
      color:#fff;
      text-align:center;
      font-weight:900;
      letter-spacing: 1px;
      padding: 10px 12px;
      font-size: 18px;
      text-transform: uppercase;
      position: relative;
    }
    .ribbon:before,
    .ribbon:after{
      content:"";
      position:absolute;
      top:0;
      width: 24px;
      height: 100%;
      background: rgba(255,255,255,.14);
      transform: skewX(-18deg);
    }
    .ribbon:before{ left: 10px; }
    .ribbon:after{ right: 10px; }

    /* Main body */
    .id-body{
      padding: 14px 18px 12px;
    }

    .photo{
      width: 112px;
      height: 112px;
      border-radius: 10px;
      border: 2px solid rgba(148,163,184,.35);
      overflow:hidden;
      background:#f1f5f9;
    }
    .photo img{
      width:100%;
      height:100%;
      object-fit: cover;
    }

    .kv-row{
      display:flex;
      gap:10px;
      padding: 7px 0;
      border-bottom: 1px solid var(--line);
      align-items: baseline;
    }
    .kv-row:last-child{ border-bottom: 0; }

    .k{
      min-width: 95px;
      color: var(--blue2);
      font-weight: 800;
    }
    .v{
      color: var(--text);
      font-weight: 700;
    }

    /* Section title bar */
    .section-title{
      margin: 12px 0 8px;
      background: linear-gradient(135deg, #0d3b85, #1c57b3);
      color:#fff;
      font-weight:900;
      font-size: 18px;
      padding: 10px 12px;
      border-radius: 10px;
      text-align:center;
    }

    /* Bullet rows like sample */
    .dot-row{
      display:flex;
      align-items:center;
      gap:10px;
      padding: 8px 0;
      border-bottom: 1px solid var(--line);
    }
    .dot{
      width:10px;height:10px;border-radius:50%;
      background: var(--blue2);
      flex: 0 0 10px;
    }
    .dot-k{
      min-width: 120px;
      font-weight: 900;
      color: var(--blue2);
    }
    .dot-v{
      font-weight: 700;
      color: var(--text);
    }

    /* Footer strip */
    .id-footer{
      padding: 14px 18px 14px;
      position: relative;
    }

    .account-badge{
      display:inline-block;
      background: linear-gradient(135deg, var(--blue1), var(--blue2));
      color:#fff;
      font-weight:900;
      padding: 8px 12px;
      border-radius: 10px;
      margin-bottom: 10px;
    }

    .sign-row{
      display:flex;
      justify-content: space-between;
      align-items:flex-end;
      gap: 14px;
      margin-top: 10px;
    }
    .sign-line{
      flex: 1;
      border-bottom: 2px solid rgba(15,23,42,.25);
      height: 22px;
      position: relative;
    }
    .sign-label{
      font-size: 10px;
      color: var(--muted);
      font-weight: 800;
      margin-top: 6px;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .bottom-strip{
      background: linear-gradient(135deg, var(--blue1), var(--blue2));
      color:#fff;
      padding: 10px 18px;
      display:flex;
      justify-content: space-between;
      align-items:center;
      font-weight: 800;
      font-size: 12px;
    }

    .bottom-strip small{
      font-weight: 700;
      opacity: .9;
    }

    /* Print sizing (optional) */
    @media print{
      body{ background:#fff; }
      .id-wrap{ margin:0; max-width:none; }
      .id-card{ box-shadow:none; }
    }
	.dot-v{
	  font-weight: 700;
	  color: var(--text);
	  word-break: break-all;        /* Break long URLs */
	  overflow-wrap: anywhere;      /* Modern wrapping */
	}
	/* Signature Area */
	.signature-area{
	  display:flex;
	  justify-content:flex-end;
	  align-items:flex-end;
	  margin-top: 8px;
	}

	.signature-box{
	  text-align:center;
	  min-width:160px;
	}

	.signature-img{
	  max-width:150px;
	  height:auto;
	  margin-bottom:4px;
	}

	.signature-line{
	  border-top:2px solid rgba(15,23,42,.4);
	  margin-top:4px;
	}

	.signature-label{
	  font-size:10px;
	  letter-spacing:1px;
	  font-weight:700;
	  color:var(--muted);
	  margin-top:4px;
	}
      .Status-based-cont{
          padding-left: 30px;
          padding-right: 30px;
      }
      [dir=ltr] .card {
    background: var(--glass);
    border: 1px solid var(--glass-border);
    border-radius: 18px;
    backdrop-filter: blur(12px);
    box-shadow: 0 18px 45px rgba(0, 0, 0, .25);
          color: #FFF;
}
      
      [dir=ltr] .card-header:first-child{
          border-radius: 18px 18px 0 0;
      }
      
      [dir=ltr] .card .badge{
          background: rgba(255, 193, 7, .15);
    border: 1px solid rgba(255, 193, 7, .35);
    color: var(--accent);
          font-size: 18px;
      }
      
      [dir=ltr] .text-muted{
          color: #FFF;
      }
      
      [dir=ltr] .btn.btn-accent {
    background: var(--accent);
    color: #111;
    border: none;
    border-radius: 999px;
    font-weight: 700;
    padding: 10px 18px;
}
      [dir=ltr] .form-control{
          background: rgba(255, 255, 255, .12) !important;
    color: #fff;
    border: 1px solid rgba(255, 255, 255, .18) !important;
    border-radius: 999px;
    font-weight: 400;
    padding: 10px 18px;
    height: auto;
      }
      
      
      
  </style>
	<div class="id-wrap">
		<div class="id-card">

			<!-- Top -->
			<div class="id-top">
				<div class="brand">
					<div class="logo">WH</div>
					<div>
					<h1>WebHaven Academy</h1>
					<small>LEARN • GROW • SUCCEED</small>
					</div>
				</div>
			</div>

			<!-- Ribbon -->
			<div class="ribbon">Student ID Card</div>
			<?php
			if($student['student_image'] != ''){
			  $src = $student['student_image'];
			} else {
			  $src = 'uploads/no-image.jpg';
			}
		  ?>
			<!-- Body -->
			<div class="id-body">
				<div class="row g-3 align-items-start">
				<div class="col-4">
				<div class="photo">
				<!-- Replace with your student image -->
				<img src="<?php echo base_url($src);?>" alt="Student Photo">
				</div>
				</div>

				<div class="col-8">
				<div class="kv-row">
				<div class="k">Name:</div>
				<div class="v"><?php echo $student['student_name'];?></div>
				</div>
				<div class="kv-row">
				<div class="k">Student ID:</div>
				<div class="v"><?php echo $student['student_no']; ?></div>
				</div>
				</div>
				</div>

				<div class="section-title">More Information</div>

				<div class="dot-row">
					<span class="dot"></span>
					<div class="dot-k">Total point:</div>
					<div class="dot-v"><?php echo $student['student_point']; ?></div>
				</div>
				<div class="dot-row">
					<span class="dot"></span>
					<div class="dot-k">Bonus points:</div>
					<div class="dot-v"><?php echo $student['joining_point']; ?></div>
				</div>
				<div class="dot-row">
					<span class="dot"></span>
					<div class="dot-k">TL Name:</div>
					<div class="dot-v"><?php echo $student['tl_firstname'].' '.$student['tl_lastname'];?></div>
				</div>
				<?php if($this->session->userdata('student_status')==1){ ?>
					<div class="dot-row" style="border-bottom:0;">
						<span class="dot"></span>
						<div class="dot-k">Trainer Name:</div>
						<div class="dot-v"><?php echo $student['firstname'].' '.$student['lastname'];?></div>
					</div>
					<div class="dot-row" style="border-bottom:0;">
						<span class="dot"></span>
						<div class="dot-k">Reference Link:</div>
						<div class="dot-v">
						<a href="<?php echo $this->session->userdata('refer_link');?>" 
						target="_blank" 
						class="text-decoration-none text-break">
						<?php echo $this->session->userdata('refer_link');?>
						</a>
						</div>
					</div>			
				<?php } ?>
			</div>
			<!-- Signature -->
			<div class="signature-area">
			<div class="signature-box">
			<!-- Replace with your signature image -->
			<img src="<?php echo base_url('studentassets'); ?>/sig.jpg" class="signature-img" alt="Authorized Signature">

			<div class="signature-line"></div>
			<div class="signature-label">AUTHORIZED SIGNATURE</div>
			</div>
			</div>
			<div class="bottom-strip">
			<div>WebHaven Academy</div>
			<small>www.webhavenmedia.com</small>
			</div>

		</div>
	</div>


    <!-- Status-based actions -->
    <div class="Status-based-cont">
    <div class="row">

		<?php if($this->session->userdata('student_status')==0){ ?>
		<div class="col-md-6 mb-3" style="display: none;">
			<div class="quick-card">
				<h5><i class="fa fa-telegram-plane"></i> Subscribe Youtube Channel</h5>
				<p>Stay updated with announcements & tasks.</p>

				<?php if($this->session->userdata('id')){ ?>
				<a class="btn btn-primary" onclick="gotolink('<?php echo $this->session->userdata('id') ?>', 'https://youtube.com/@webhavenacademy-p1y', 'youtube');">Subscribe</a>
				<?php } else { ?>
				<a class="btn btn-primary" href="https://youtube.com/@webhavenacademy-p1y" target="_blank">Subscribe</a>
				<?php } ?>
			</div>
		</div>

		<div class="col-md-6 mb-3" style="display: none;">
			<div class="quick-card">
				<h5><i class="fa fa-facebook"></i> Join Facebook Group</h5>
				<p>Get support and daily updates quickly.</p>

				<?php if($this->session->userdata('id')){ ?>
				<a class="btn btn-success" onclick="gotolink('<?php echo $this->session->userdata('id') ?>', 'https://www.facebook.com/share/1CCgfmjC7C/', 'facebook');">Follow</a>
				<?php } else { ?>
				<a class="btn btn-success" href="https://www.facebook.com/share/1CCgfmjC7C/" target="_blank">Join</a>
				<?php } ?>
			</div>
		</div>

		<?php if($student['student_point'] >= $activation_point){ ?>
		<div class="col-12 mb-4">
			<div class="alert alert-info d-flex align-items-center justify-content-between" style="border-radius:14px;">
				<div>
				<strong>Activation available:</strong> You have enough points to request account activation.
				</div>
				<a class="btn btn-success" onclick="accountActive(<?php echo $student['student_id']; ?>);">
				<i class="material-icons" style="font-size:18px;vertical-align:middle;">send</i>
				Account Activation Request
				</a>
			</div>
		</div>
		<?php } ?>

		<?php } ?>

		<?php if($this->session->userdata('student_status')==1){ ?>

			<div class="col-md-6 mb-3">
                
<!--				<div class="card card-soft">-->
                <div class="card card-glass">
<!--					<div class="card-header"><strong>Refer To Other</strong></div>-->
					<div class="card-body">
                        <span class="badge rounded-pill px-3 py-2 mb-3">Refer To Other </span>
						<p class="mb-3">Share your referral link via WhatsApp.</p>
						<a href="https://api.whatsapp.com/send?text=<?php echo $this->session->userdata('refer_link');?>"
						target="_blank" class="btn btn-accent">
						<i class="material-icons" style="font-size:18px;vertical-align:middle;">send</i>
						New Refer Request
						</a>
					</div>
				</div>
			</div>

			<div class="col-md-6 mb-3">
				<div class="card card-soft">
<!--					<div class="card-header"><strong>Copy Referral Link</strong></div>-->
					<div class="card-body">
                        <span class="badge rounded-pill px-3 py-2 mb-3">Copy Referral Link </span>
						<div class="copy-box">
						<input type="text" class="form-control" id="copyText"
						value="<?php echo $this->session->userdata('refer_link');?>" readonly>
						<button type="button" class="btn btn-accent" id="copyButton">
						Copy
						</button>
						</div>
						<small class="d-block mt-2">Use this link to invite new students.</small>
					</div>
				</div>
			</div>

			<div class="col-12" style="margin-top:10px;margin-bottom:60px;">
				<div class="card card-glass" style="text-align: center; align-items: center;">
                    <div class="card-body">
<!--					<h5>Active Student Group</h5>-->
                    <span class="badge rounded-pill px-3 py-2 mb-3">Active Student Group </span>
					<p>Join the official WhatsApp group for active students.</p>
					<a href="https://chat.whatsapp.com/EtDN0714YFeBekqpss0hrQ" target="_blank" class="btn btn-accent">
					Join Now
					</a>
                        </div>
				</div>
			</div>

		<?php } ?>

	</div><!-- /row -->
        </div>
    
</div><!-- /content -->

<?php $this->load->view('student/footer'); ?>

<script>
function accountActive(id){
  $.ajax({
    type: "POST",
    url: '<?php echo base_url('student/profile/active'); ?>',
    data: {student_id: id},
    dataType: "text",
    cache:false,
    success: function(data){
      alert(data);
      location.reload();
    }
  });
}
</script>

<script>
document.getElementById("copyButton") && document.getElementById("copyButton").addEventListener("click", function() {
  const textToCopy = document.getElementById("copyText");
  textToCopy.select();
  textToCopy.setSelectionRange(0, 99999);

  navigator.clipboard.writeText(textToCopy.value).then(() => {
    alert("Copied: " + textToCopy.value);
  }).catch(err => {
    console.error("Copy failed: ", err);
  });
});
</script>

<script>
function gotolink(id, link, type){
  $.ajax({
    url: '<?php echo base_url("page/sendlink"); ?>',
    method: 'POST',
    data: { id: id, type: type },
    success: function(response) {
      if(response == 'success') {
        location.href = link;
      } else {
        alert("You have unauthorize access");
      }
    }
  });
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // Replace visible text
    function replaceText(node) {
        if (node.nodeType === 3) {
            node.textContent = node.textContent.replace(
                /kosdigital\.in/g,
                'webhavenmedia.com'
            );
        } else {
            node.childNodes.forEach(replaceText);
        }
    }

    replaceText(document.body);

    // Replace links and image sources
    document.querySelectorAll('[href],[src]').forEach(function(el) {
        if (el.href) {
            el.href = el.href.replace(
                /https?:\/\/(www\.)?kosdigital\.in/gi,
                'https://webhavenmedia.com'
            );
        }

        if (el.src) {
            el.src = el.src.replace(
                /https?:\/\/(www\.)?kosdigital\.in/gi,
                'https://webhavenmedia.com'
            );
        }
    });

});
</script>