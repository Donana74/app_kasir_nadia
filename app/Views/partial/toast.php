<!--<?php if(!empty(session()->getFlashData('errors'))) : ?>
    <div class="position-fixed top-0 right-0 p-3 toast-master" style="z-index: 9999; right: 0; top: 0;">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">Error Terjadi!</strong>
            <small>sekarang</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            <ul class="text-danger">
                <?php foreach(session()->getFlashData('errors') as $error) : ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var toastElement = document.querySelector('.toast');
        var toastMaster = document.querySelector('.toast-master');

        toastElement.classList.add('show');

        setTimeout(function () {
            toastMaster.innerHTML = '';
        }, 3000);
    });
    </script>
<?php endif; ?>