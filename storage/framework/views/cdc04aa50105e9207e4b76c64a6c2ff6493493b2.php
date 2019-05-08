<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card-body">
            <?php if(session('status')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <div class='row'>
                <div class="col-md-4 card">
                    <div class="box box-primary">
                        <div class="box-body box-profile bg-primary">
                            <img class="rounded mx-auto d-block avatar" src="<?php echo e(url('/')); ?>/imgs/<?php echo e($user->avatar); ?>"
                                 alt="User profile picture">
                            <h3 class="profile-username text-center text-white name1"><?php echo e($user->name); ?></h3>
                            <p class="text-center text-white">Software Engineer</p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item center"><i class="fas fa-mail-bulk"></i>
                                    <b>Gmail</b> <a class="pull-right"><?php echo e($user->email); ?></a>
                                </li>
                                <li class="list-group-item center"><i class="fas fa-users"></i>
                                    <b>Tham gia từ</b> <a class="text-right"><?php echo e($user->created_at); ?></a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <a class="btn btn-primary" href="/home"><i class="fas fa-newspaper"></i>Bảng
                        Tin</a><br> <?php if($user->style=="admin"): ?>
                        <a class="btn btn-primary" href="/admin"><i class="fas fa-address-book"></i>Quản trị thành viên</a>
                        <br> <?php endif; ?>
                    <label></label>
                    <div class="container">
                        <form class="form-group" action="/update_user" method="POST" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?> 
                            <input type="hidden" id="id" name="id" value="<?php echo e($user->id); ?>" required><br>
                            <div class="text-center text-primary"><i class="fas fa-user-tag"></i> Cập nhật ảnh đại diện
                            </div>
                            <input class="btn btn-primary" id="file" type="file" name="select_file"
                                   value="<?php echo e($user->avatar); ?>" required/> 
                            <div style="margin:12px;" class="text-center"><input class="btn btn-primary"
                                                                                 onclick="return confirm('xác nhận thông tin sửa');"
                                                                                 type="submit" id="ok" name="ok"
                                                                                 value="cập nhật ảnh đại diện"><br>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8 card">
                    <form action="/add_post/<?php echo e($user_id); ?>" method="POST" style="margin-top:16px;">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">

                            <input type="hidden" name="user_id" id="user_id" value="<?php echo e($user_id); ?>">
                            <textarea class="form-control" rows="5" id="content" name="content"
                                      placeholder="Bạn đang nghĩ gì? ngày hôm nay của bạn thế nào ?"></textarea>
                            <button style="margin-top:5px;" type="submit" class="btn btn-default btn-primary"><i
                                    class="far fa-grin-wink"></i>Đăng
                            </button>
                        </div>
                    </form>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class=" border row">
                            <div class="col-md-10">
                                <div class="user-block">
                                    <img class=" avatar1" src="<?php echo e(url('/')); ?>/imgs/<?php echo e($key->user->avatar); ?>"
                                         alt="user image">
                                    <span class="username">
                                        <a class="name" href="#"><?php echo e($key->user->name); ?></a>
                                    </span>
                                    <div class="description">Shared publicly - <?php echo e($key->user->created_at); ?></div>
                                </div>
                                <p>
                                    <?php echo e($key->content); ?>

                                </p>
                                <div class="text-primary"><i class="fas fa-chevron-circle-down"></i><a
                                        href="/post/<?php echo e($key->id); ?>">xem thêm</a></div>
                            </div>
                            <div class="col-md-2 text-primary" style="padding-left:60px;">
                                <i class="fas fa-trash-alt"></i><span><a href="/delete/<?php echo e($key->id); ?>">xóa</a></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\git-laravel\resources\views/add_post.blade.php ENDPATH**/ ?>