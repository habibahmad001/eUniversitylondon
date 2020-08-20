
$(".add-button").click(function () {
  reset_form();
  showFormOverlay();

  $(".add-new-data").animate({
    width: "650px"
  }, {
    duration: 500,

  });
});



$(".edit-icon").click(function () {
  reset_form("edit-");
  showFormOverlay();
  var t_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "650px"
  }, {
    duration: 500,
  });

  var user_folder = $("#user_folder").val();
  $.get('/' + user_folder + '/getteams/' + t_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.Teams != 'undefined'){
      Teams = data.Teams;

      var img_path = $("#img_path").val() + "/";

      $("#edit-t_name").val(Teams.teams_name);
      $("#edit-t_desc").summernote('code', Teams.teams_desc);
      $("#edit-t_role").val(Teams.teams_role);
      // $("#edit-t_role").val(Teams.SocialMedia);
      var SocialMedia = JSON.parse(Teams.SocialMedia);
      if(SocialMedia) {
        $("#edit-social_icon-1").val(SocialMedia.SocialIcon[0]);
        $("#edit-link-1").val(SocialMedia.SocialLink[0]);

        for(var i=1; i<=SocialMedia.SocialIcon.length; i++) {
          if(typeof SocialMedia.SocialIcon[i] != "undefined") {
            social_item(SocialMedia.SocialIcon[i], SocialMedia.SocialLink[i], "edit-");
          }
        }
      } else {
        $("#edit-social_icon-1").val();
        $("#edit-link-1").val();
      }

      $("#t_id").val(t_id);

      if(Teams.teams_img !== null) {
        $("#avatar_div img").attr("src", img_path + Teams.teams_img);
      }

      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});


function reset_form(type="") {

  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#"+type+"t_name").val('');
  $("#"+type+"t_desc").val('');
  $("#"+type+"t_role").val('');
  $("#"+type+"social_icon-1").val('');
  $("#"+type+"link-1").val('');
  $("."+type+"add-social-item").html('<input type="hidden" name="idcount" id="idcount" value="0">');
  $("#"+type+"avatar_div img").attr("src", "http://via.placeholder.com/150/000000/FFFFFF/?text=File Placeholder");
}

function validate(type) {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var errors = [];

  var t_name = $("#"+ type +"t_name").val();
  var t_desc = $("#"+ type +"t_desc").val();
  var t_role = $("#"+ type +"t_role").val();
  var social_icon1 = $("#"+ type +"social_icon-1").val();
  var link = $("#"+ type +"link-1").val();


  if(t_name == '') {
    errors.push("#"+ type +"t_name");
  }

  if(t_desc == '') {
    errors.push("#"+ type +"t_desc");
  }

  if(t_role == '') {
    errors.push("#"+ type +"t_role");
  }

  if(social_icon1 == '') {
    errors.push("#"+ type +"social_icon-1");
  }

  if(link == '') {
    errors.push("#"+ type +"link-1");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    return false;
  }

  return true;
}

function social_item(iconval="", linkval="", type="") {
  var idcount	= jQuery("#"+type+"idcount").val();
  jQuery("#"+type+"idcount").val(Number(idcount)+1);
  jQuery("."+type+"add-social-item").append('<div class="socialItem" id="socialItem-'+(Number(idcount)+1)+'"><select name="social_icon[]" id="social_icon-'+(Number(idcount)+1)+'" class="custom-select mr-sm-2 w-40-percent">\n' +
      '          <option value="">Choose...</option>\n' +
      '          <option value="fa fa-facebook">Facebook</option>\n' +
      '          <option value="fa fa-paper-plane">Link External</option>\n' +
      '          <option value="fa fa-linkedin">LinkeDin</option>\n' +
      '          <option value="fa fa-instagram">Instagram</option>\n' +
      '          <option value="fa fa-youtube-play">YouTube</option>\n' +
      '        </select>\n' +
      '        <input type="text" name="link[]" id="link-'+(Number(idcount)+1)+'" value="'+linkval+'" class="w-40-percent" placeholder="Link Here ..." >\n' +
      '        <button type="button" class="btn btn-danger btn-sm" name="button" onclick="javascript:remove_social_item('+(Number(idcount)+1)+');"> <i class="fa fa-minus"></i> </button></div>');
      if(iconval != "") {
        $("#social_icon-"+(Number(idcount)+1)+" option").each(function() {
          if($(this).val() == iconval) {
            $(this).attr("selected","selected");
          }
        });
      }
}

function remove_social_item(id) {
  jQuery("#socialItem-" + id).remove();
}