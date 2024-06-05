  <script>
    lucide.createIcons();

    function signOut() {
      $.post("./admin/action.php?action=signout", _ => {
        location.reload();
      });
    }

    let nav_open = false;
    $("#open_sidebar").click(() => {
      if (nav_open) {
        $("#logo-sidebar").removeClass("-translate-x-full");
      } else {
        $("#logo-sidebar").addClass("-translate-x-full");
      }

      nav_open = !nav_open;
    })
  </script>
  </body>

  </html>