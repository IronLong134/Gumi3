 
<?php $__env->startSection('content'); ?>
<div class="container">

  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03"
        aria-expanded="false" aria-label="Toggle navigation">
                              <span class="navbar-toggler-icon"></span>
                            </button>
      <a class="navbar-brand" href="\home">Home</a>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="\home">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
  </div>
  <div class="row justify-content-center">



    <div class="card-body">
      <?php if(session('status')): ?>
      <div class="alert alert-success" role="alert">
        <?php echo e(session('status')); ?>

      </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-md-4">
          <div class="box box-primary">
            <div class="box-body box-profile">
              <div class="rounded mx-auto d-block"><img class=" rounded mx-auto d-block avatar" src="<?php echo e(url('/')); ?>/imgs/<?php echo e($user1->avatar); ?>" alt="User profile picture"></div>
              <h3 class="profile-username text-center"><?php echo e($user1->name); ?></h3>

              <p class="text-muted text-center">Quản trị viên</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <a href="\profile_post\<?php echo e($user1->id); ?>" class="btn btn-primary btn-block"><b>Trang cá nhân</b></a>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4">
          <div class="box box-primary">
            <div class="box-body box-profile">
              <div class="rounded mx-auto d-block"><img class=" rounded mx-auto d-block avatar" src="<?php echo e(url('/')); ?>/imgs/<?php echo e($key->avatar); ?>" alt="User profile picture"></div>
              <h3 class="profile-username text-center"><?php echo e($key->name); ?></h3>

              <p class="text-muted text-center"><?php echo e($key->email); ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>
    </div>
  </div>


</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* D:\laravelproject\laravel-blog\resources\views/admin.blade.php */ ?>