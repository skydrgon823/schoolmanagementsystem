<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });
    let contentPhotoElement = document.getElementById("imgPhoto");
    let contentSignElement = document.getElementById("imgSign");
    async function changeSignature(){
        let files = await selectFile("image/*", true);
        if(files!=null){
            contentSignElement.innerHTML = files.map(file => `<img src="${URL.createObjectURL(file)}" style="width: 200px; height: 50px;">`).join('');
            flash({msg:"Your signature photo has been successfully updated", type:'success'})
        }
    }

    $(document).ready(function() {
        // $('.filename').addClass('active-state');
        // $('#uniform-school_photo .action').text("Change Image");
    });
    document.getElementById('school_photo').onchange = function (evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                document.getElementById("schoolPhoto").src = fr.result;
            }
            fr.readAsDataURL(files[0]);
        }
        else {
        }
    }

</script>
