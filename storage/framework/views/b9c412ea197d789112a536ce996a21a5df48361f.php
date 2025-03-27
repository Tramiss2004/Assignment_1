<DOCTYPE! html> 

<html>
    <head>
        <title>GBN</title>
    </head>
    <body>
        <div>
            <h1>Welcome to GBN</h1>
        </div>
        <div>
            <div>
                <h2>Please choose one of them to login.</h2>
            </div>
            <div>
                <a href="/LoginForStaff">
                    <button>
                        Staff Login
                    </button>
                </a>
            </div> 
            <br> 
            <div>
                <a href="/LoginForAdmin">
                    <button>
                        Admin Login
                    </button>
                </a>
            </div>    
        </div>
        <?php if (isset($component)) { $__componentOriginal88b1957f21f7f49b400717e8d0a27189798132bf = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Footer::class, []); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal88b1957f21f7f49b400717e8d0a27189798132bf)): ?>
<?php $component = $__componentOriginal88b1957f21f7f49b400717e8d0a27189798132bf; ?>
<?php unset($__componentOriginal88b1957f21f7f49b400717e8d0a27189798132bf); ?>
<?php endif; ?>
    </body>
</html><?php /**PATH C:\Degree course\Year 3 Sem 1\Advanced Web Application Development\Assignment\Assignment_1\resources\views/MainPage.blade.php ENDPATH**/ ?>