function validate(type) {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var errors = [];

  var title = $("#"+ type +"title_0").val();
  var typee = $("#"+ type +"type_0").val();


  if(title == '') {
    $("#"+ type +"title_0").css({"border": "1px solid red"});
    errors.push("#"+ type +"title_0");
  }

  if(typee == '') {
    errors.push("#"+ type +"type_0");
    $("#"+ type +"type_0").css({"border": "1px solid red"});
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    return false;
  }

  return true;
}

function removeitems(ID) {
  jQuery("#sectionID_"+ID).remove();
}

function applysommernot(ID) {
  jQuery("#contentarr_" + ID).summernote({
    height: 200,
    tabsize: 2,
    placeholder: 'Type some text here . .'
  });
}

function repetar() {
  var idcount	= jQuery("#RepeateItem").val();
  jQuery("#RepeateItem").val(Number(idcount)+1);
  jQuery(".InsertItems").append('<div class="unit-section" id="sectionID_'+(Number(idcount)+1)+'">\n' +
      '                        <div class="unitHeader text-right">\n' +
      '                            <button type="button" class="btn btn-danger" onclick="javascript:removeitems('+(Number(idcount)+1)+');">X</button>\n' +
      '                        </div>\n' +
      '                        <div class="unitBody">\n' +
      '                            <div class="unit-row">\n' +
      '                                <div class="unit-Item">\n' +
      '                                    <div class="form-line">\n' +
      '                                        <label>Title:</label>\n' +
      '                                        <input type="text" name="title[]" id="title_'+(Number(idcount)+1)+'" placeholder="Title. . ." >\n' +
      '                                    </div>\n' +
      '                                </div>\n' +
      '                                <div class="unit-Item">\n' +
      '                                    <div class="form-line">\n' +
      '                                        <label>Content/Unit Type:</label>\n' +
      '                                        <select name="type[]" id="type_'+(Number(idcount)+1)+'" onchange="javascript:jQuery(\'#sectionID_'+(Number(idcount)+1)+' .OperationRow\').hide(300);jQuery(\'#\'+jQuery(this).val()).show(300);applysommernot('+(Number(idcount)+1)+');">\n' +
      '                                            <option value="">---- Select Option ----</option>\n' +
      '                                            <option value="Content_'+(Number(idcount)+1)+'">Content</option>\n' +
      '                                            <option value="Iframe_'+(Number(idcount)+1)+'">Iframe</option>\n' +
      '                                            <option value="Youtube_'+(Number(idcount)+1)+'">Youtybe</option>\n' +
      '                                            <option value="Video_'+(Number(idcount)+1)+'">Video</option>\n' +
      '                                            <option value="Image_'+(Number(idcount)+1)+'">PDF</option>\n' +
      '                                            <option value="Quiz_'+(Number(idcount)+1)+'">Quiz</option>\n' +
      '                                        </select>\n' +
      '                                    </div>\n' +
      '                                </div>\n' +
      '                                <div class="unit-Item OperationRow" id="Content_'+(Number(idcount)+1)+'">\n' +
      '                                    <div class="form-line">\n' +
      '                                        <label>Content:</label>\n' +
      '                                        <textarea name="contentarr[]" id="contentarr_'+(Number(idcount)+1)+'" placeholder="Type some text here . . ."></textarea>\n' +
      '                                    </div>\n' +
      '                                    <div class="form-line">\n' +
      '                                        <label>Duration:</label>\n' +
      '                                        <input type="text" name="contentdur[]" id="contentdur_'+(Number(idcount)+1)+'" placeholder="1:30">\n' +
      '                                    </div>\n' +
      '                                </div>\n' +
      '                                <div class="unit-Item OperationRow" id="Iframe_'+(Number(idcount)+1)+'">\n' +
      '                                    <div class="form-line">\n' +
      '                                        <label>Iframe:</label>\n' +
      '                                        <textarea name="iframearr[]" id="iframearr_'+(Number(idcount)+1)+'" placeholder="Iframe here. . ." ></textarea>\n' +
      '                                    </div>\n' +
      '                                    <div class="form-line">\n' +
      '                                        <label>Duration:</label>\n' +
      '                                        <input type="text" name="iframedur[]" id="iframedur_'+(Number(idcount)+1)+'" placeholder="1:30">\n' +
      '                                    </div>\n' +
      '                                </div>\n' +
      '                                <div class="unit-Item OperationRow" id="Youtube_'+(Number(idcount)+1)+'">\n' +
      '                                    <div class="form-line">\n' +
      '                                        <label>Youtube embed link:</label>\n' +
      '                                        <input type="text" name="youtubearr[]" id="youtubearr_'+(Number(idcount)+1)+'" placeholder="Youtybe embed link here. . ." >\n' +
      '                                    </div>\n' +
      '                                    <div class="form-line">\n' +
      '                                        <label>Duration:</label>\n' +
      '                                        <input type="text" name="youtubedur[]" id="youtubedur_'+(Number(idcount)+1)+'" placeholder="1:30">\n' +
      '                                    </div>\n' +
      '                                </div>\n' +
      '                                <div class="unit-Item OperationRow" id="Video_'+(Number(idcount)+1)+'">\n' +
      '                                    <div class="form-line">\n' +
      '                                        <label>Video:</label>\n' +
      '                                        <input type="file" name="videoarr[]" id="videoarr_'+(Number(idcount)+1)+'">\n' +
      '                                        <p style="font-size: 11px !important; color: red">Only .mp4 format supported and file must less then 100MB</p>\n' +
      '                                    </div>\n' +
      '                                    <div class="form-line">\n' +
      '                                        <label>Duration:</label>\n' +
      '                                        <input type="text" name="videodur[]" id="videodur_'+(Number(idcount)+1)+'" placeholder="1:30">\n' +
      '                                    </div>\n' +
      '                                </div>\n' +
      '                                <div class="unit-Item OperationRow" id="Image_'+(Number(idcount)+1)+'">\n' +
      '                                    <div class="form-line">\n' +
      '                                        <label>PDF:</label>\n' +
      '                                        <input type="file" name="imgarr[]" id="imgarr_'+(Number(idcount)+1)+'">\n' +
      '                                    </div>\n' +
      '                                    <div class="form-line">\n' +
      '                                        <label>Duration:</label>\n' +
      '                                        <input type="text" name="imgdur[]" id="imgdur_'+(Number(idcount)+1)+'" placeholder="1:30">\n' +
      '                                    </div>\n' +
      '                                </div>\n' +
      '                                <div class="unit-Item OperationRow" id="Quiz_'+(Number(idcount)+1)+'">\n' +
      '                                    <div class="form-line">\n' +
      '                                        <label>Select Quiz:</label>\n' +
      '                                        <select name="quizarr[]" id="quizarr_'+(Number(idcount)+1)+'">\n' +
      '                                                 <option value="{!! $v->id !!}">{!! $v->quiz_title !!}</option>\n' +
      '                                        </select><br />\n' +
      '                                    </div>\n' +
      '                                    <div class="form-line">\n' +
      '                                        <label>Duration:</label>\n' +
      '                                        <input type="text" name="quizdur[]" id="quizdur_'+(Number(idcount)+1)+'" placeholder="1:30">\n' +
      '                                    </div>\n' +
      '                                </div>\n' +
      '                                 <div class="form-line activediv">\n' +
      '                                    <input type="checkbox" name="isactive[]" id="isactive_'+(Number(idcount)+1)+'" value="'+(Number(idcount)+1)+'">\n' +
      '                                        <label>Only for registered users</label>\n' +
      '                                </div>\n' +
      '                            </div>\n' +
      '                        </div>\n' +
      '                    </div>');

    /********* Load Quiz **********/
    var user_folder = $("#user_folder").val();
    var cid = $("#cidd").val();
    $.get('/' + user_folder + '/getajaxquiz/' + cid, function(data){

      if(typeof data.ResponseData != 'undefined'){
        // alert(data.ResponseData);
        $("#quizarr_"+(Number(idcount)+1)).html(data.ResponseData);
      }
    });
    /********* Load Quiz **********/
}