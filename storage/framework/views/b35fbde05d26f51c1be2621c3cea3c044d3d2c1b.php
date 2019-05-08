<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card-body">
                <?php if(session('status')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>
                <div class="row">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4" id="myTable">
                            <div class="box box-primary" style="margin-top:15px;">
                                <div class="box-body box-profile">
                                    <div class="rounded mx-auto d-block"><img class=" rounded mx-auto d-block avatar"
                                                                              src="<?php echo e(url('/')); ?>/imgs/<?php echo e($user->avatar); ?>"
                                                                              alt="User profile picture"></div>
                                    <h3 class="profile-username text-center"><?php echo e($user->name); ?></h3>
                                    <p class="text-muted text-center"><?php echo e($user->email); ?></p>
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
                                    <?php
                                    $check = 'no';
                                    foreach ($user1[0]->sender as $value) {
                                        if ($value->receive_id == $user->id && $value->accept == 1 && $value->delete_at == 0) {
                                            $check = 'friend';

                                        } else if ($value->receive_id == $user->id && $value->accept == 0 && $value->delete_at == 0) {
                                            $check = 'sended';
                                        }
                                    }
                                    foreach ($user->sender as $friend) {
                                        if ($friend->receive_id == $user1[0]->id && $friend->accept == 0 && $friend->delete_at == 0) {
                                            $check = 'request';
                                        } else if ($friend->receive_id == $user1[0]->id && $friend->accept == 1 && $friend->delete_at == 0) {
                                            $check = 'friend';
                                        }
                                    }
                                    ?>
                                    <?php if($check == 'friend'): ?>
                                        <div class="dropdown" style="text-align: center">
                                            <button class="btn btn-success dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><i class="fas fa-arrow-left"></i>
                                                Bạn bè
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                    <a class="dropdown-item"
                                                       href="\refuse\<?php echo e($user->id); ?>\<?php echo e($user1[0]->id); ?>">Hủy kết bạn</a>
                                            </div>
                                        </div>
                                    <?php elseif($check == 'sended'): ?>
                                        <div class="dropdown" style="text-align: center">
                                            <button class="btn btn-danger dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><i class="fas fa-arrow-left"></i>
                                                Bạn đã gửi lời mòi kết bạn
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="\accept\<?php echo e($user->id); ?>\<?php echo e($user1[0]->id); ?>">Chấp
                                                    nhận lời mời
                                                    <a class="dropdown-item"
                                                       href="\refuse\<?php echo e($user->id); ?>\<?php echo e($user1[0]->id); ?>">Xóa</a>
                                            </div>
                                        </div>
                                    <?php elseif($check == 'request' ): ?>
                                        <div class="dropdown" style="text-align: center">
                                            <button class="btn btn-danger dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><i class="fas fa-arrow-right"></i>
                                                Đang chờ bạn xác nhận lời mời
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="\accept\<?php echo e($user->id); ?>\<?php echo e($user1[0]->id); ?>">Chấp
                                                    nhận lời mời
                                                    <a class="dropdown-item"
                                                       href="\refuse\<?php echo e($user->id); ?>\<?php echo e($user1[0]->id); ?>">Xóa</a>
                                            </div>
                                        </div>

                                    <?php elseif($check == 'no'): ?>

                                        <a href="\send_rq\<?php echo e($user->id); ?>" class="btn btn-primary btn-block"><b>Gửi lời
                                                mời
                                                kết bạn</b></a>

                                    <?php endif; ?>
                                    
                                    
                                </div>
                                <!-- /.box-body -->

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#myInput').on('keyup', function (event) {
                event.preventDefault();
                /* Act on the event */
                var tukhoa = $(this).val().toLowerCase();
                $('#myTable > div').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(tukhoa) > -1);
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\git-laravel\resources\views/all_people.blade.php ENDPATH**/ ?>