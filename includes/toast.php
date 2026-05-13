<!-- Toast Container -->
<div id="toast-container" class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
    <?php if(isset($_SESSION['toast_msg'])): ?>
        <div class="toast align-items-center text-white bg-primary border-0 show" role="alert">
            <div class="d-flex">
                <div class="toast-body"><?php echo $_SESSION['toast_msg']; unset($_SESSION['toast_msg']); ?></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    <?php endif; ?>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toasts = document.querySelectorAll('.toast');
        toasts.forEach(t => {
            setTimeout(() => t.classList.remove('show'), 5000);
        });
    });
</script>
