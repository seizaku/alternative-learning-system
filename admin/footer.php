<script>
  lucide.createIcons();

  var table = new DataTable('#datatable', {
    responsive: true,
    order: [[0, 'asc']],
    buttons: ['copy', 'excel', 'pdf', 'colvis']
  });
  table.buttons().container()
    .appendTo($('div.eight.column:eq(0)', table.table().container()));
  table.buttons().container()
    .insertBefore('#datatable');


  $("#filter_table").change(() => {
    let val = $("#filter_table").val();
    table.search(val).draw();
  });

  function signOut() {
    $.post("./action.php?action=signout", _ => {
      location.reload();
    });
  }

  function closeModal() {
    $("#modal").hide();
    $('form')[0].reset();
    $("#profile_view").attr("src", "./assets/blank-profile.webp");
  }

  function showModal() {
    $("#modal").show();
    $('form')[0].reset();
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