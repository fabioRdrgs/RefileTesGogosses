

$("#fileSelect").on('change',function(e){
var maxFiles = 4;
var acceptedExt = ["jpg","png","jpeg"];
fileCount = e.currentTarget.files;

if(fileCount.length > maxFiles)
$("form").prepend("<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Attention vous avez sélectionné trop de fichiers!</div>");

for(i = 0; i < fileCount.length;i++)
{
    fileType = fileCount[i]['type'].split('/')[1];
    if(jQuery.inArray(fileType,acceptedExt,0) == -1)
    $("form").prepend("<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Veuillez sélectionner uniquement des images !</div>");
}
});

$("#fileSelect").on('click',function(){
    if($("#errorDiv") != null)
    $("#errorDiv").remove();
})