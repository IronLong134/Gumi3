<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card-body">
            <?php if(session('status')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <div class="card">
                <input type="hidden" name="csrf-token" content="<?php echo e(csrf_token()); ?>">
                <div class="title1 bg-primary text-white text-center">CẬP NHẬT THÔNG TIN</div>
                <div class="upload_picture">
                    <div class="center"><img id="avatar" class="avatar_upload"
                                             src="<?php echo e(url('/')); ?>/imgs/<?php if($user->avatar): ?><?php echo e($user->avatar); ?><?php elseif(!$user->avatar && $user->gender==1): ?><?php echo e("avatar_male.jpg"); ?><?php else: ?><?php echo e("avatar_female.jpg"); ?><?php endif; ?>"
                                             alt="User profile picture"></div>
                    <div class="container">
                        <form class="form-group" action="/update_avatar" method="POST" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?> 
                            <input type="hidden" id="id" name="id" value="<?php echo e($user->id); ?>"><br>
                            <div class="text-center text-primary"><i class="fas fa-user-tag"></i> Cập nhật ảnh đại diện
                            </div>
                            <div class="text-center"><input class="btn btn-primary" id="file" type="file"
                                                            name="select_file"
                                                            value="<?php echo e($user->avatar); ?>"/></div>
                            <div class="text-center"><input class="btn btn-primary"
                                                            onclick="return confirm('xác nhận thông tin sửa');"
                                                            type="submit" id="ok" name="ok"
                                                            value="Thêm ảnh"><br>
                            </div>
                        </form>
                    </div>
                    <div class="container text-center">
                        <div class="row">
                            <?php if($images): ?>
                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-3" id="<?php echo e($key); ?>">
                                        <img class="avatar_upload list-img" data="<?php echo e($image); ?>"
                                             src="<?php echo e(url('/')); ?>/imgs/<?php echo e($image); ?>"
                                             alt="User profile picture">
                                        <div>
                                            <button class="btn btn-primary">Xóa ảnh</button>
                                            <button class="btn btn-success btn-avatar">cập nhật làm ảnh đại diện</button>
                                        </div>
                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
                }
            });
            $('div .row').on('click', '.btn-primary', function (e) {
                e.preventDefault();
                $(this).parent().parent().remove();

                var listImg = $('.list-img');
                var newListImg = '';

                listImg.each(function (idx, val) {
                    newListImg += $(val).attr('data') + ' ';
                });

                newListImg.substr(newListImg.length - 1, newListImg.length);

                var url = '/deleteImage';
                $.ajax
                ({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    data: {
                        images: newListImg
                    },
                    success: function (res) {
                        console.log(res);
                    }
                });
                return false;

            })
            $('div .row').on('click', '.btn-avatar', function (e) {
                e.preventDefault();
               // $(this).parent().parent().remove();

                var listImg = $(this).parent().parent().find('img');
                var image= listImg.attr('data');
                $('#avatar').attr('src',"http://localhost:8000/imgs/"+ image);
                // var newListImg = '';
                //
                // listImg.each(function (idx, val) {
                //     newListImg += $(val).attr('data') + ' ';
                // });

                //newListImg.substr(newListImg.length - 1, newListImg.length);

                var url = '/updateAvatar';
                $.ajax
                ({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    data: {
                        image: image
                    },
                    success: function () {

                    }
                });
                return false;
            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\git-laravel\resources\views/images.blade.php ENDPATH**/ ?>