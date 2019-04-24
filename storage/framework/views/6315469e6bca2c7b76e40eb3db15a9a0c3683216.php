 
<?php $__env->startSection('content'); ?>
<div class="main-chat">
</div>
<!-- div.main-chat -->
<div class="box-chat">
  <form method="POST" id="formSendMsg" onsubmit="return false;">
    <input type="text" placeholder="Nhập nội dung tin nhắn ...">
  </form>
  <!-- form#formSendMsg -->
</div>
<!-- div.box-chat -->



<!-- div.box-chat -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* D:\laravelproject\laravel-blog\resources\views/chat.blade.php */ ?>