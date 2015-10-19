function browse()
{
  $("#browse_item").addClass("active");
  $("#add_item").removeClass("active");
  $("#exit_item").removeClass("active");
  if ($("#book_list").hasClass("hidden")) {
    $("#book_list").removeClass("hidden");
    $("#book_detail").addClass("hidden");
  };
}

function add()
{
  $("#add_item").addClass("active");
  $("#browse_item").removeClass("active");
  $("#exit_item").removeClass("active");
}

function exit()
{
  $("#exit_item").addClass("active");
  $("#browse_item").removeClass("active");
  $("#add_item").removeClass("active");
}

function detail()
{
  if ($("#book_detail").hasClass("hidden")) {
    $("#book_detail").removeClass("hidden");
    $("#book_list").addClass("hidden");
  };
}