<?php $__env->startSection('content'); ?>

    <body class="hold-transition skin-blue sidebar-mini" style="font-family:Arial;">
    <div class="container">
        <div class="wrapper">
            <input type="hidden" name="csrf-token" content="<?php echo e(csrf_token()); ?>">
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="center">
                                <h2 class="name1 text-primary">
                                    User Profile
                                </h2>
                            </div>
                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile bg-primary" style="padding-top:8px;">
                                    <img class="rounded mx-auto d-block avatar 11111"
                                         src="<?php echo e(url('/')); ?>/imgs/<?php echo e($user->avatar); ?>" alt="User profile picture">
                                    <h3 class="profile-username text-center text-white name1"><?php echo e($user->name); ?></h3>

                                    <p class=" text-center text-white">Software Engineer</p>

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

                                    <a href="/profile_post/<?php echo e($user->id); ?>" class="btn btn-primary btn-block"><b>Trang cá
                                            nhân</b></a>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                            <!-- About Me Box -->
                            <div class="box box-primary bg-white">
                                <div class="box-header with-border center text-primary" style="margin-top:7px">
                                    <h3 class="box-title name1">About Me</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body " style="margin-left:10px;">
                                    <strong class="text-primary"><i class="fa fa-book margin-r-5"></i>
                                        Education</strong>

                                    <p class="text-muted ">
                                        B.S. in Computer Science from the University of Tennessee at Knoxville
                                    </p>
                                    <hr>
                                    <strong class="text-primary"><i class="fas fa-map-marker-alt"></i> Location</strong>
                                    <p class="text-muted">Malibu, California</p>
                                    <hr>
                                    <strong class="text-primary"><i class="fas fa-pen-nib"></i> Skills</strong>
                                    <p>
                                        <span class="badge badge-primary">UI Design</span>
                                        <span class="badge badge-secondary">Coding</span>
                                        <span class="badge badge-success">Javascript</span>
                                        <span class="badge badge-danger">PHP</span>
                                        <span class="badge badge-info">Node.js</span>
                                    </p>

                                    <hr>

                                    <strong class="text-primary"><i class="far fa-sticky-note"></i> Notes</strong>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim
                                        neque.</p>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs" style="margin-left:21px">
                                    <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                                    <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                                    <li><a href="#settings" data-toggle="tab">Settings</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="active tab-pane card post" id="myTable">
                                        <!-- Post -->
                                        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                            <div class="post">
                                                <div class="user-block">
                                                    <img class=" avatar1"
                                                         src="<?php echo e(url('/')); ?>/imgs/<?php echo e($data->user->avatar); ?>"
                                                         alt="user image">
                                                    <span class="username">
                                                    <a class="name" href="#"><?php echo e($data->user->name); ?></a>
                                                    <a href="#" class="pull-right btn-box-tool"></a>
                                                    </span>
                                                    <div class="description"><i class="fas fa-globe-americas"></i>Shared
                                                        publicly - <?php echo e($data->created_at); ?></div>
                                                </div>
                                                <!-- /.user-block -->
                                                <p>
                                                    <?php echo e($data->content); ?>

                                                </p>
                                                <?php
                                                $Like = 'Like';
                                                foreach ($data->like as $value) {
                                                    # code...
                                                    if ($value->user_id == $user->id && $value->delete_at == 0) {
                                                        $Like = "Liked";
                                                    }
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <div id="like<?php echo e($data->id); ?>">

                                                            <a id="like_btn" href="javascript:void(0)"
                                                               class="<?php if($Like == 'Like'): ?>btn btn-primary <?php elseif($Like=='Liked'): ?>btn btn-danger <?php endif; ?>"
                                                               post_id="<?php echo e($data->id); ?>"><i
                                                                    class="far fa-thumbs-up"></i> Like
                                                                (<b><?php echo e(count($data->like)); ?></b>)</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="margin-left:40px">
                                                        <a href="post/<?php echo e($data->id); ?>" class="btn btn-primary"> <i
                                                                class="fas fa-comments"></i>Comments(<?php echo e(count($data->comment)); ?>

                                                            )</a>
                                                    </div>
                                                </div>
                                                <form class="form-horizontal" style="margin-top:8px;"
                                                      action="add_comment/<?php echo e($data->id); ?>/<?php echo e($user->id); ?>"
                                                      method="POST">
                                                    <?php echo e(csrf_field()); ?>

                                                    <div class="form-group margin-bottom-none">
                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <input type="hidden" name="user_id"
                                                                       value="<?php echo e($user->id); ?>">
                                                                <input type="hidden" name="post_id"
                                                                       value="<?php echo e($data->id); ?>">
                                                                <input class="form-control input-sm" name="content"
                                                                       placeholder="type a comment">
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <button type="submit"
                                                                        class="btn btn-danger pull-right btn-block btn-sm">
                                                                    Send
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <!-- /.post -->

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="timeline">
                                        <!-- The timeline -->
                                        <ul class="timeline timeline-inverse">
                                            <!-- timeline time label -->
                                            <li class="time-label">
                                                    <span class="bg-red">
                                                     10 Feb. 2014
                                                     </span>
                                            </li>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <li>
                                                <i class="fa fa-envelope bg-blue"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an
                                                        email</h3>

                                                    <div class="timeline-body">
                                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo
                                                        kaboodle quora plaxo ideeli hulu weebly
                                                        balihoo...
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a class="btn btn-primary btn-xs">Read more</a>
                                                        <a class="btn btn-danger btn-xs">Delete</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <li>
                                                <i class="fa fa-user bg-aqua"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a>
                                                        accepted your friend request
                                                    </h3>
                                                </div>
                                            </li>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <li>
                                                <i class="fa fa-comments bg-yellow"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on
                                                        your post</h3>

                                                    <div class="timeline-body">
                                                        Take me to your leader! Switzerland is small and neutral! We are
                                                        more like Germany, ambitious and misunderstood!
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- END timeline item -->
                                            <!-- timeline time label -->
                                            <li class="time-label">
                                                <span class="bg-green">
                                                    3 Jan. 2014
                                                </span>
                                            </li>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <li>
                                                <i class="fa fa-camera bg-purple"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new
                                                        photos</h3>

                                                    <div class="timeline-body">
                                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- END timeline item -->
                                            <li>
                                                <i class="fa fa-clock-o bg-gray"></i>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="settings">
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="inputName"
                                                           placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="inputEmail"
                                                           placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName"
                                                           placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputExperience"
                                                       class="col-sm-2 control-label">Experience</label>

                                                <div class="col-sm-10">
                                                    <textarea class="form-control" id="inputExperience"
                                                              placeholder="Experience"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputSkills"
                                                           placeholder="Skills">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"> I agree to the <a href="#">terms and
                                                                conditions</a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-user bg-yellow"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span class="label label-success pull-right">95%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span class="label label-warning pull-right">50%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span class="label label-primary pull-right">68%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Some information about this general settings option
                                </p>
                            </div>
                            <!-- /.form-group -->


                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Other sets of options are available
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right">
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript:void(0)" class="text-red pull-right"><i
                                            class="fa fa-trash-o"></i></a>
                                </label>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            $(".row").on('click', '#like_btn', function () {
                var this_a = $(this);
                var id = this_a.attr("post_id"); //lay id video\
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
                        var likeclass = res.data.success ? 'btn-danger' : 'btn-primary';
                        this_a.removeClass('btn-danger');
                        this_a.removeClass('btn-primary');
                        this_a.addClass(likeclass);
                        this_a.find('b').html(res.data.likes);
                    }
                });
                return false;
            });
        });
    </script>
    </body>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\git-laravel\resources\views/wall.blade.php ENDPATH**/ ?>