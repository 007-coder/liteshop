<?php 
defined('YV_LiteShop') or die ('Restricted Access!');
$calls = $data['template_content']['calls'];
$CountCalls = $data['template_content']['CountCalls'];

?>

<?php /*  ?>
<div class="row mb-3">
	<div class="col-xl-8 mb-5 mb-xl-0">
		<h1>call me</h1>	
	</div>	
</div>
<?php */ ?>

<div class="row">
  <div class="col">
    <div class="card shadow">

      <div class="card-header border-0">
        <h3 class="mb-0"><?php echo $i18n->t('MLT_CALL_ME'); echo ($CountCalls) ? ' - '.$CountCalls.' '.$i18n->t('OTHER_PCS') : ''; ?></h3>
      </div>

      

      <div class="table-responsive <?php echo (!$CountCalls) ? 'no_calls' : '' ?>">

      	<?php //Таблица с заказами ?>
      	<?php if ($CountCalls>0) { ?>
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Project</th>
              <th scope="col">Budget</th>
              <th scope="col">Status</th>
              <th scope="col">Users</th>
              <th scope="col">Completion</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">
                <div class="media align-items-center">
                  <a href="#" class="avatar rounded-circle mr-3">
                    <img alt="Image placeholder" src="../assets/img/theme/bootstrap.jpg">
                  </a>
                  <div class="media-body">
                    <span class="mb-0 text-sm">Argon Design System</span>
                  </div>
                </div>
              </th>
              <td>
                $2,500 USD
              </td>
              <td>
                <span class="badge badge-dot mr-4">
                  <i class="bg-warning"></i> pending
                </span>
              </td>
              <td>
                <div class="avatar-group">
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Ryan Tompson">
                    <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Romina Hadid">
                    <img alt="Image placeholder" src="../assets/img/theme/team-2-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Alexander Smith">
                    <img alt="Image placeholder" src="../assets/img/theme/team-3-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Jessica Doe">
                    <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg" class="rounded-circle">
                  </a>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">60%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                    </div>
                  </div>
                </div>
              </td>
              <td class="text-right">
                <div class="dropdown">
                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                <div class="media align-items-center">
                  <a href="#" class="avatar rounded-circle mr-3">
                    <img alt="Image placeholder" src="../assets/img/theme/angular.jpg">
                  </a>
                  <div class="media-body">
                    <span class="mb-0 text-sm">Angular Now UI Kit PRO</span>
                  </div>
                </div>
              </th>
              <td>
                $1,800 USD
              </td>
              <td>
                <span class="badge badge-dot">
                  <i class="bg-success"></i> completed
                </span>
              </td>
              <td>
                <div class="avatar-group">
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Ryan Tompson">
                    <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Romina Hadid">
                    <img alt="Image placeholder" src="../assets/img/theme/team-2-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Alexander Smith">
                    <img alt="Image placeholder" src="../assets/img/theme/team-3-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Jessica Doe">
                    <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg" class="rounded-circle">
                  </a>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">100%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                  </div>
                </div>
              </td>
              <td class="text-right">
                <div class="dropdown">
                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                <div class="media align-items-center">
                  <a href="#" class="avatar rounded-circle mr-3">
                    <img alt="Image placeholder" src="../assets/img/theme/sketch.jpg">
                  </a>
                  <div class="media-body">
                    <span class="mb-0 text-sm">Black Dashboard</span>
                  </div>
                </div>
              </th>
              <td>
                $3,150 USD
              </td>
              <td>
                <span class="badge badge-dot mr-4">
                  <i class="bg-danger"></i> delayed
                </span>
              </td>
              <td>
                <div class="avatar-group">
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Ryan Tompson">
                    <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Romina Hadid">
                    <img alt="Image placeholder" src="../assets/img/theme/team-2-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Alexander Smith">
                    <img alt="Image placeholder" src="../assets/img/theme/team-3-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Jessica Doe">
                    <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg" class="rounded-circle">
                  </a>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">72%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%;"></div>
                    </div>
                  </div>
                </div>
              </td>
              <td class="text-right">
                <div class="dropdown">
                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                <div class="media align-items-center">
                  <a href="#" class="avatar rounded-circle mr-3">
                    <img alt="Image placeholder" src="../assets/img/theme/react.jpg">
                  </a>
                  <div class="media-body">
                    <span class="mb-0 text-sm">React Material Dashboard</span>
                  </div>
                </div>
              </th>
              <td>
                $4,400 USD
              </td>
              <td>
                <span class="badge badge-dot">
                  <i class="bg-info"></i> on schedule
                </span>
              </td>
              <td>
                <div class="avatar-group">
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Ryan Tompson">
                    <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Romina Hadid">
                    <img alt="Image placeholder" src="../assets/img/theme/team-2-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Alexander Smith">
                    <img alt="Image placeholder" src="../assets/img/theme/team-3-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Jessica Doe">
                    <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg" class="rounded-circle">
                  </a>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">90%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                    </div>
                  </div>
                </div>
              </td>
              <td class="text-right">
                <div class="dropdown">
                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                <div class="media align-items-center">
                  <a href="#" class="avatar rounded-circle mr-3">
                    <img alt="Image placeholder" src="../assets/img/theme/vue.jpg">
                  </a>
                  <div class="media-body">
                    <span class="mb-0 text-sm">Vue Paper UI Kit PRO</span>
                  </div>
                </div>
              </th>
              <td>
                $2,200 USD
              </td>
              <td>
                <span class="badge badge-dot mr-4">
                  <i class="bg-success"></i> completed
                </span>
              </td>
              <td>
                <div class="avatar-group">
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Ryan Tompson">
                    <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Romina Hadid">
                    <img alt="Image placeholder" src="../assets/img/theme/team-2-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Alexander Smith">
                    <img alt="Image placeholder" src="../assets/img/theme/team-3-800x800.jpg" class="rounded-circle">
                  </a>
                  <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Jessica Doe">
                    <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg" class="rounded-circle">
                  </a>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">100%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                  </div>
                </div>
              </td>
              <td class="text-right">
                <div class="dropdown">
                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <?php } else { ?>
	        <div class="row mr-2 ml-2 align-items-center justify-content-center">
	        	<div class="col-5">
	        		<h1 class="text-center"><i class="ni ni-mobile-button text-red mr-2"></i><?php echo $i18n->t('PAGE_CALLS_NO_CALLS') ?></h1>
	        	</div>        	
	        </div>
        <?php } ?>
      </div>
			
			<?php //pagination ?>
			<?php if ($CountCalls>0) { ?>
      <div class="card-footer py-4">
        <nav aria-label="...">
          <ul class="pagination justify-content-end mb-0">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1">
                <i class="fas fa-angle-left"></i>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">
                <i class="fas fa-angle-right"></i>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

