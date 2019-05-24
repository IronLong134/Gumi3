<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/autoload.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/sendmsg.js')); ?>" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- ************8-->
    

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
    <!-- ************8-->

    <!-- ************8-->
    <!-- icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
          crossorigin="anonymous">


    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet">
    <!-- new -->


</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <?php echo e(config('app.name', 'Laravel')); ?>

            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                        </li>
                        <?php if(Route::has('register')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                            </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php endif; ?> <?php else: ?>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false" v-pre>
                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <?php echo e(__('Logout')); ?>

                </a>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                      style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </li>

        </ul>
</div>
</div>
</nav>
<div>
    <section class="content-header">


        <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarTogglerDemo03"
                        aria-controls="navbarTogglerDemo03"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand text-white" href="\home"><i
                        class="far fa-newspaper"></i> Bảng tin
                </a>


                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link text-white"
                               href="/profile_post/<?php echo e(Auth::user()->id); ?>"><img
                                    class=" avatar1"
                                    src="<?php echo e(url('/')); ?>/imgs/<?php if(Auth::user()->avatar): ?><?php echo e(Auth::user()->avatar); ?><?php elseif(!Auth::user()->avatar && Auth::user()->gender==1): ?><?php echo e("avatar_male.jpg"); ?><?php else: ?><?php echo e("avatar_female.jpg"); ?><?php endif; ?>"
                                    alt=""> <?php echo e(Auth::user()->name); ?> <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white"
                               href="/rq_friends/<?php echo e(Auth::user()->id); ?>"><i
                                    class="fas fa-envelope-open-text"></i>Lời mời kết
                                bạn<span class="badge badge-danger"><?php echo e(count($request)); ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white"
                               href="/list_friends/<?php echo e(Auth::user()->id); ?>"><i
                                    class="fas fa-user-friends"></i>Bạn bè(<?php echo e(count($count_friends)); ?>)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/all_people"><i
                                    class="fas fa-users"></i>Mọi người</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <?php echo e(csrf_field()); ?>

                        <input class="form-control mr-sm-2" id="myInput" type="search" placeholder="Search"
                               aria-label="Search" required>
                        <button class="btn btn-info my-2 my-sm-0" type="submit" >Search
                        </button>
                    </form>
                </div>
            </nav>
        </div>

    </section>
</div>


<?php endif; ?>


</div>
</body>
<main class="py-4">
    <?php echo $__env->yieldContent('content'); ?>
</main>
</html>
<?php /**PATH C:\project\git-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>