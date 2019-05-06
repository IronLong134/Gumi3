<?php $__env->startSection('content'); ?>
    <div class="container">

        <div class="card-body container">
            <?php if(session('status')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <?php $__currentLoopData = $friends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card request">
                    <div class="row user-block">
                        <div class="col-md-3" style="text-align:right; ">
                            <img class=" avatar1" src="<?php echo e(url('/')); ?>/imgs/<?php echo e($friend->sender->avatar); ?>"
                                 alt="user image">
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="name1 text-primary"><?php echo e($friend->sender->name); ?></div>
                                <div style="margin-left:10px">đã gửi lời mởi kết bạn</div>

                            </div>

                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-primary" href="\accept\<?php echo e($friend->sender->id); ?>\<?php echo e($user->id); ?>">Chấp nhận</a>
                        </div>
                        <div class="col-md-1">
                            <a href="\refuse\<?php echo e($friend->sender->id); ?>\<?php echo e($user->id); ?>" class="btn btn-primary">Xóa</a>
                        </div>
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\git-laravel\resources\views/rq_friends.blade.php ENDPATH**/ ?>