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
                        <div class="box-body box-profile" style="margin-top:7px;">
                            <input type="hidden" name="csrf-token" content="<?php echo e(csrf_token()); ?>">
                            <img class="rounded mx-auto d-block avatar"
                                 src="<?php echo e(url('/')); ?>/imgs/<?php echo e($post[0]->user->avatar); ?>" alt="User profile picture">
                            <h3 class="profile-username text-center name1 text-primary"><?php echo e($post[0]->user->name); ?></h3>

                            <p class="text-muted text-center">Software Engineer</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item center">
                                    <b>Followers</b> <a class="pull-right">1,322</a>
                                </li>
                                <li class="list-group-item center">
                                    <b>Following</b> <a class="text-right">543</a>
                                </li>
                                <li class="list-group-item center">
                                    <b>Friends</b> <a class="text-right">13,287</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <a class="btn btn-primary" href="/home">Trang chủ</a><br>
                    <label></label>
                    <a class="btn btn-primary" href="/profile_post/<?php echo e($user->id); ?>">Trang cá nhân của tôi</a><br>
                    <label></label>
                </div>
                <div class="col-md-8 card">
                    <div class="user-block">
                        <div class="inline"><img class=" avatar1" src="<?php echo e(url('/')); ?>/imgs/<?php echo e($post[0]->user->avatar); ?>"
                                                 alt="user image">
                            <a class="name" href="#" style="font-size:x-large;"><?php echo e($post[0]->user->name); ?></a>
                            <div class="description">Shared publicly <?php echo e($post[0]['created_at']); ?></div>
                        </div>

                        <div style="height:120px; padding-top:13px; margin-bottom:-13px;"
                             class="bg-primary text-white center"><?php echo e($post[0]['content']); ?></div>
                        <br>
                        <div class="row" style="margin-bottom:7px;">
                            <div class="col-md-1">

                                <?php
                                $like = 'like';
                                foreach ($post[0]->like as $value) {
                                    if ($value->user_id == $user->id) {
                                        $like = 'liked';
                                    }

                                }
                                ?>
                                <div>
                                    <a id="like_btn" href="javascript:void(0)"
                                       class="<?php if($like == 'like'): ?>btn btn-primary <?php elseif($like=='liked'): ?> btn btn-danger <?php endif; ?> "
                                       action="0"
                                       post_id="<?php echo e($post[0]->id); ?>"><i class="far fa-thumbs-up"></i>
                                        Like(<b><?php echo e(count($post[0]->like)); ?></b>)</a>
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-left:40px">
                                <button class="btn btn-primary"><i
                                        class="fas fa-comments"></i>Comments(<?php echo e(count($post[0]->comment)); ?>)
                                </button>
                            </div>
                        </div>

                        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-inline">
                                <div class="inline"><img class=" avatar1" src="<?php echo e(url('/')); ?>/imgs/<?php echo e($comment->user->avatar); ?>"
                                                         alt="user image"><a href=""><?php echo e($comment->user->name); ?></a>
                                    <span style="margin-left:11px;"><?php echo e($comment->content); ?></span>

                                </div>
                            </div><br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <form class="form-horizontal" style="margin-top:10px"
                              action="add_comment/<?php echo e($post[0]->id); ?>/<?php echo e($user->id); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group margin-bottom-none">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                        <input type="hidden" name="post_id" value="<?php echo e($post[0]->id); ?>">
                                        <input class="form-control input-sm" name="content"
                                               placeholder="type a comment">
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#like_btn").click(function (e) {
                e.preventDefault();
                var id = $(this).attr("post_id"); //lay id video\
                var url = '/' + id + '/addLike';

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax
                ({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function (res) {
                        var this_a = $("#like_btn");
                        var likeclass = res.data.success ? 'btn-danger' : 'btn-primary';
                        this_a.removeClass('btn-danger');
                        this_a.removeClass('btn-primary');
                        this_a.addClass(likeclass);
                        $('b').html(res.data.likes);
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\git-laravel\resources\views/post.blade.php ENDPATH**/ ?>