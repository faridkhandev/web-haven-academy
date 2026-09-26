<?php $this->load->view('student/header'); ?>
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<?php if(empty($childcourses)){ ?>
		<div class="hero-banner bg-primary d-flex flex-row align-items-center" style="height:250px;">
			<div class="container-fluid page__container">
				<div class="d-flex flex-column">
					<div class="mb-1">
						<a href="<?php echo base_url('student/course');?>" class="badge badge-dark-gray text-white">Back to Courses</a>
					</div>
					<div class="d-flex align-items-center mb-3">
						<div class="mr-3">
							<img src="<?php echo base_url() ;?>/weblogin/image/<?php echo $course['course_image'];?>" width="100" alt="<?php echo $course['course_name'];?>">
						</div>
						<div>
							<h1 class="text-white mb-0"><?php echo $course['course_name'];?></h1>
							<?php if($complete){?>
							<h3 class="text-white mb-0">Course Completed</h3>
							<?php } ?>
						</div>
					</div>
				</div>	
			</div>
		</div>
		<style>
		/* Whole page wrapper background */
		.course-wrap{
		  background: radial-gradient(circle at top left, rgba(255,255,255,.6), transparent 45%),
					  radial-gradient(circle at bottom right, rgba(255,255,255,.35), transparent 45%);
		  border-radius: 18px;
		}

		/* Shared panel */
		.panel{
		  border-radius: 18px;
		  box-shadow: 0 14px 40px rgba(0,0,0,.12);
		  position: relative;
		  overflow: hidden;
		}

		/* Left panel gradient */
		.panel-left{
		  background: linear-gradient(135deg, #ff5f6d 0%, #ffc371 100%);
		}

		/* Right panel gradient */
		.panel-right{
		  background: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%);
		}

		/* Light text */
		.text-white-75{ color: rgba(255,255,255,.82); }
		.description-text{ line-height: 1.75; }

		/* Glow badge */
		.badge-glow{
		  background: rgba(255,255,255,.22);
		  color: #fff;
		  border: 1px solid rgba(255,255,255,.35);
		  padding: 8px 12px;
		  border-radius: 999px;
		  backdrop-filter: blur(6px);
		}

		/* Soft progress bar bg */
		.progress-soft{
		  background: rgba(255,255,255,.25);
		  border-radius: 999px;
		  overflow: hidden;
		}

		/* Bright button */
		.btn-bright{
		  background: rgba(255,255,255,.95);
		  color: #2b2b2b;
		  border: none;
		  font-weight: 600;
		  border-radius: 12px;
		  padding: 10px 14px;
		}
		.btn-bright:hover{
		  background: #fff;
		  transform: translateY(-1px);
		}

		/* Search pill */
		.search-pill{
		  display:flex;
		  align-items:center;
		  gap:8px;
		  padding: 8px 12px;
		  border-radius: 999px;
		  background: rgba(255,255,255,.20);
		  border: 1px solid rgba(255,255,255,.35);
		  backdrop-filter: blur(8px);
		}
		.search-icon{ color:#fff; }
		.search-input{
		  border:0;
		  outline:none;
		  background: transparent;
		  color:#fff;
		  width: 190px;
		}
		.search-input::placeholder{ color: rgba(255,255,255,.78); }

		/* Session card */
		.session-card .session-inner{
		  background: rgba(255,255,255,.92);
		  border-radius: 16px;
		  padding: 14px;
		  border: 1px solid rgba(255,255,255,.55);
		  transition: transform .18s ease, box-shadow .18s ease;
		}
		.session-card:hover .session-inner{
		  transform: translateY(-5px);
		  box-shadow: 0 18px 40px rgba(0,0,0,.18);
		}

		/* Session typography */
		.session-kicker{
		  font-size: 11px;
		  letter-spacing: .14em;
		  color: #6c757d;
		  font-weight: 700;
		}
		.session-title{
		  font-size: 22px;
		  font-weight: 800;
		  color: #111827;
		  line-height: 1.1;
		}
		.session-sub{
		  font-size: 13px;
		  color: #6b7280;
		}
		.mini{
		  font-size: 12px;
		  color: #475569;
		}

		/* Small chip */
		.chip{
		  font-size: 11px;
		  font-weight: 800;
		  letter-spacing: .08em;
		  padding: 6px 10px;
		  border-radius: 999px;
		  background: linear-gradient(135deg, #22c55e, #16a34a);
		  color: #fff;
		}
          
          
         

		/* Mobile */
		@media (max-width: 576px){
		  .search-input{ width: 140px; }
		}
		</style>
		
		<div class="container-fluid page__container py-4 course-wrap">
  <div class="row g-4">

    <!-- LEFT PANEL -->
    <div class="col-lg-5">
      <div class="panel panel-left p-4 h-100">

        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="fw-bold mb-0 text-white">Course Description</h5>
          <span class="badge badge-glow">
            <?php echo (int)$course['no_of_classes']; ?> Sessions
          </span>
        </div>

        <div class="text-white-75 description-text">
          <?php echo strip_tags(html_entity_decode($course['course_description'], ENT_QUOTES, 'UTF-8'), "<p><br><b><strong><ul><li>"); ?>
        </div>

        <div class="mt-4">
          <div class="d-flex justify-content-between small text-white-75 mb-1">
            <span>Course Progress</span>
            <span>0%</span>
          </div>
          <div class="progress progress-soft" style="height:10px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="width:0%"></div>
          </div>
        </div>

        <div class="mt-4 d-grid gap-2">
          <a href="#sessions" class="btn btn-bright">Explore Sessions</a>
          <a href="<?php echo base_url('student/course'); ?>" class="btn btn-outline-light">Back</a>
        </div>

      </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="col-lg-7" id="sessions">
      <div class="panel panel-right p-4 h-100">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
          <div>
            <h5 class="fw-bold mb-0 text-white">Course Sessions</h5>
            <div class="small text-white-75">Pick a session and start learning 🚀</div>
          </div>

          <div class="search-pill">
            <span class="search-icon">🔍</span>
            <input type="text" id="sessionSearch" class="search-input" placeholder="Search session (e.g. 5)">
          </div>
        </div>

        <div class="row g-3" id="sessionGrid">
          <?php for($i=1; $i <= (int)$course['no_of_classes']; $i++){ ?>
            <div class="col-12 col-md-6  mt-4">
              <a
                href="<?php echo base_url('student/course/sessionview'); ?>?id=<?php echo $course['course_id']; ?>&session_no=<?php echo $i; ?>"
                class="session-card text-decoration-none d-block"
                data-session="<?php echo $i; ?>"
              >
                <div class="session-inner">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <div class="session-kicker">SESSION</div>
                      <div class="session-title">#<?php echo $i; ?></div>
                      <div class="session-sub">Notes • Videos • Practice</div>
                    </div>
                    <span class="chip">OPEN</span>
                  </div>

                  <div class="mt-3 d-flex justify-content-between align-items-center">
                    <div class="mini">⏱ Self-paced</div>
                    <div class="mini fw-semibold">View →</div>
                  </div>
                </div>
              </a>
            </div>
          <?php } ?>
        </div>

        <div id="noSessions" class="text-center text-white-75 py-5 d-none">
          No sessions found.
        </div>

      </div>
    </div>

  </div>
</div>

		<!-- Nice hover + polish -->
		<style>
		.session-hover { transition: transform .15s ease, box-shadow .15s ease; }
		.session-hover:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(0,0,0,.08) !important; }
		</style>

		<!-- Search filter (vanilla JS) -->
		<script>
		(function(){
		  const input = document.getElementById('sessionSearch');
		  const cards = document.querySelectorAll('#sessionGrid .session-card');
		  const empty = document.getElementById('noSessions');

		  function filter(){
			const q = (input.value || '').trim().toLowerCase();
			let shown = 0;

			cards.forEach(a => {
			  const n = a.getAttribute('data-session');
			  const ok = ('session ' + n).includes(q) || n.includes(q);
			  a.closest('.col-12').style.display = ok ? '' : 'none';
			  if(ok) shown++;
			});

			empty.classList.toggle('d-none', shown !== 0);
		  }

		  if(input) input.addEventListener('input', filter);
		})();
		</script>
	<?php }else{ ?>
	<div class="page__heading border-bottom">
		<div class="container-fluid page__container">
			<h1 class="mb-0">Course List</h1>
		</div>
	</div>
  
  <style>
   .CoursesPic{
        height: 250px;
        position: relative;
        margin-bottom: 15px;
    }

    .CoursesPic img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
   .course__subtitle{
        color: #FFF;
        font-size: 15px;
        list-style: 24px;
        font-weight: 700;
        text-align: center;
    }
    .card__course{
        height: 100%;
    }
    .page__container .card{
      height: auto;
      padding: 15px;
    }
    .course__subtitle{
      max-width: 220px;
    }
    
    
  </style>
	<div class="container-fluid page__container">
		<div class="row">
		    <div class="col-md-12"><center>ACTIVITY HUB(এক্টিভিটি হাব) Courses</center></div>
			<?php foreach($childcourses as $item){?>
			<div class="col-md-4">
				<div class="card card__course">
                  <div class="CoursesPic">
					<img src="<?php echo base_url() ;?>/weblogin/image/<?php echo $item['course_image'];?>" alt="img">
                  </div>
					<a style="font-size:.8rem;padding: 5px;" class="card-header__title justify-content-center align-self-center d-flex flex-column" href="<?php echo base_url('student/course/view') ;?>?id=<?php echo $item['course_id'];?>">
						<span class="course__subtitle"  style="text-transform:uppercase;"><?php echo $item['course_name'];?></span>
					</a>
				</div>
              
			</div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
</div>	
<?php $this->load->view('student/footer'); ?>