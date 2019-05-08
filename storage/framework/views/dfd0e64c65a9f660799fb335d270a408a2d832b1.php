<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card-body container">
            <?php if(session('status')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <div class="container">
                <div class="text-center text-primary name">Danh sách bạn bè</div>
                <div class="row" id="myTable">

                    <?php $__currentLoopData = $friends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $avatar = 'null';
                        $name = 'null';
                        $updated_at = 'null';
                        if ($friend->sender_id == Auth::user()->id) {
                            $id = $friend->receive->id;

                            $avatar = $friend->receive->avatar;
                            $name = $friend->receive->name;
                            $updated_at = $friend->receive->updated_at;
                        } else if ($friend->receive_id == Auth::user()->id) {
                            $id = $friend->sender->id;
                            $avatar = $friend->sender->avatar;
                            $name = $friend->sender->name;
                            $updated_at = $friend->sender->updated_at;
                        }
                        ?>
                        <div class="col-md-6 card"  >

                            <div class="inline"><img class="avatar1" src="<?php echo e(url('/')); ?>/imgs/<?php echo e($avatar); ?>">
                                <span><a class="name inline" href="#" style="font-size:x-large;"><?php echo e($name); ?></a></span>
                                <div class="dropdown" style="text-align:right; ">
                                    <button class="btn btn-success dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Bạn bè
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="\profile_friend\<?php echo e($id); ?>\<?php echo e(Auth::user()->id); ?>">Xem trang cá nhân</a>
                                            <a class="dropdown-item"
                                               href="\refuse\<?php echo e($id); ?>\<?php echo e(Auth::user()->id); ?>">Hủy kết bạn</a>
                                    </div>
                                </div>
                            </div>
                            <div class="description">Đã là bạn bè từ&ensp; <?php echo e($updated_at); ?></div>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\git-laravel\resources\views/list_friend.blade.php ENDPATH**/ ?>