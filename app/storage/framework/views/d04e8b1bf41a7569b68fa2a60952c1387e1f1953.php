<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card-body">
            <?php if(session('status')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <div class='row'>
                <div class="col-md-4 card ">
                    <div class="box box-primary">
                        <div class="box-body box-profile bg-primary">
                            <div class="imgWrapper1"><img class="avatar" src="<?php echo e(url('/')); ?>/imgs/<?php if($user->avatar): ?><?php echo e($user->avatar); ?><?php elseif(!$user->avatar && $user->gender==1): ?><?php echo e("avatar_male.jpg"); ?><?php else: ?><?php echo e("avatar_female.jpg"); ?><?php endif; ?>"
                                                          alt="User profile picture"></div>
                            <h3 class="profile-username text-center text-white name1"><?php echo e($user->name); ?></h3>
                            <h4 class="text-center text-white" ><?php if($user->nick_name): ?>(<?php echo e($user->nick_name); ?>)<?php endif; ?></h4>
                            <p class="text-center text-white intro"><?php echo e($user->intro); ?></p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-venus-mars"></i><b>giới tính</b></div>
                                        <div class="contentInfo"> <a class="pull-right"><?php if($user->gender==1): ?>Nam <?php elseif($user->gender==0): ?> Nữ <?php endif; ?></a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-phone"></i><b>  Số điện thoại</b></div>
                                        <div class="contentInfo"> <a class="pull-right"><?php echo e($user->mobile); ?></a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-mail-bulk"></i><b>Gmail</b></div>
                                        <div class="contentInfo"> <a class="pull-right"><?php echo e($user->email); ?></a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-birthday-cake"></i><b> Sinh nhật</b></div>
                                        <div class="contentInfo"> <a class="pull-right"><?php echo e($user->birthday); ?></a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-id-card-alt"></i><b> Chứng minh </b></div>
                                        <div class="contentInfo"> <a class="pull-right"><?php echo e($user->personal_id); ?></a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-briefcase"></i><b> Công việc </b></div>
                                        <div class="contentInfo"> <a class="pull-right"><?php echo e($user->job); ?></a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-futbol"></i><b> Sở thích </b></div>
                                        <div class="contentInfo"> <a class="pull-right"><?php echo e($user->favorite_1); ?>&emsp;<?php echo e($user->favorite_2); ?>&emsp;<?php echo e($user->favarite_3); ?></a></div>
                                    </div>

                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-graduation-cap"></i><b> Tốt nghiệp</b></div>
                                        <div class="contentInfo"> <a class="pull-right"><?php echo e($user->graduate_year); ?></a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-school"></i><b> Đã học tại</b></div>
                                        <div class="contentInfo"> <a class="pull-right"><?php echo e($user->university); ?></a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-school"></i><b> Đã học tại</b></div>
                                        <div class="contentInfo"> <a class="pull-right"><?php echo e($user->high_school); ?></a></div>
                                    </div>
                                </li>

                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-tint"></i><b> Nhóm máu</b></div>
                                        <div class="contentInfo"> <a class="pull-right"><?php echo e($user->blood_name); ?></a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-sign-in-alt"></i><b> Tham gia từ</b></div>
                                        <div class="contentInfo"> <a><?php echo e($user->created_at); ?></a></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <a class="btn btn-primary" href="/edit_profile/<?php echo e($user->id); ?>"><i class="fas fa-newspaper"></i>Cập nhật thông tin</a><br> <?php if($user->style=="admin"): ?>
                        <a class="btn btn-primary" href="/admin"><i class="fas fa-address-book"></i>Quản trị thành viên</a>
                        <br> <?php endif; ?>
                    <label></label>

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
                                         alt="">
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\git-laravel\resources\views/add_post.blade.php ENDPATH**/ ?>