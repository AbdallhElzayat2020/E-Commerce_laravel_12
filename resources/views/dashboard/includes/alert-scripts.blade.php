<script>
    // Enhanced alert management for dashboard
    document.addEventListener('DOMContentLoaded', function() {
        // Show all alerts with animation
        const alerts = document.querySelectorAll('.alert-success, .alert-danger, .alert-warning, .alert-info');
        alerts.forEach(function(alert) {
            alert.style.display = 'block';
            alert.classList.add('show');

            // Add fade-in animation
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';

            setTimeout(function() {
                alert.style.transition = 'all 0.3s ease';
                alert.style.opacity = '1';
                alert.style.transform = 'translateY(0)';
            }, 100);
        });

        // Auto-hide success messages after 5 seconds
        const successAlerts = document.querySelectorAll('.alert-success');
        successAlerts.forEach(function(alert) {
            setTimeout(function() {
                alert.style.transition = 'all 0.3s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 300);
            }, 5000);
        });

        // Auto-hide info messages after 7 seconds
        const infoAlerts = document.querySelectorAll('.alert-info');
        infoAlerts.forEach(function(alert) {
            setTimeout(function() {
                alert.style.transition = 'all 0.3s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 300);
            }, 7000);
        });

        // Close button functionality
        const closeButtons = document.querySelectorAll('.alert .close');
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const alert = this.closest('.alert');
                alert.style.transition = 'all 0.3s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 300);
            });
        });
    });
</script>
