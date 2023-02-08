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
        $('.filename').addClass('active-state');
        $('#uniform-photo .action').text("Change Image");
        $('#uniform-sign .action').text("Change Signature");
        $('#uniform-photo').addClass('active-state');
        $('#uniform-sign').addClass('active-state');
    });
    document.getElementById('photo').onchange = function (evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                document.getElementById("imgPhoto").src = fr.result;
            }
            fr.readAsDataURL(files[0]);
        }
        else {
        }
    }
    document.getElementById('sign').onchange = function (evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                contentSignElement.src = fr.result;
            }
            fr.readAsDataURL(files[0]);
        }
    }
    function imageSignDelete(){
        Swal.fire({
            title: "Delete Signature Picture!",
            text: "Are you sure you'd like to delete your signature picture?",
            showCancelButton: true,
            cancelButtonText: "No",
            confirmButtonColor: 'green',
            confirmButtonText: "Yes",
        }).then((result) => {
            if (result.isConfirmed) {
                contentSignElement.src = "";
                flash({msg:"Your signature photo has been successfully deleted", type:'danger'})
            }
        });
    }

    function imagePhotoDelete(e){
        e.preventDefault()
        Swal.fire({
            title: "Delete Profile Picture!",
            text: "Are you sure you'd like to delete your profile picture?",
            showCancelButton: true,
            cancelButtonText: "No",
            confirmButtonColor: 'green',
            confirmButtonText: "Yes",
        }).then((result) => {
            if (result.isConfirmed) {
                contentPhotoElement.innerHTML = `<img class="mt-3 rounded-circle" src="/global_assets/images/user.png" style="width: 100px; height: 100px;">`;
                flash({msg:"Your profile photo has been successfully deleted", type:'danger'})
            }
        });
    }

    async function changeImage(e){
        e.preventDefault()
        // $('#file-input').trigger('click');

        let files = await selectFile("image/*", true);
        if(files!=null){
            contentPhotoElement.innerHTML = files.map(file => `<img class="mt-3 rounded-circle" src="${URL.createObjectURL(file)}" style="width: 100px; height: 100px;">`).join('');
            flash({msg:"Your profile photo has been successfully updated", type:'success'})
            $('#photo').text(files[0]);
        }

    }
    function selectFile (contentType, multiple){
        return new Promise(resolve => {
            let input = document.createElement('input');
            input.type = 'file';
            input.multiple = multiple;
            input.accept = contentType;

            input.onchange = _ => {
                let files = Array.from(input.files);
                if (multiple)
                    resolve(files);
                else
                    resolve(files[0]);
            };

            input.click();
        });
    }
    function showTwoButtonImage(e){
        e.preventDefault()
        var edit_button  = document.getElementById('edit_button')
        var cancel_button = document.getElementById('cancel_button');
        var save_button = document.getElementById('save_button')
        var change_image = document.getElementById('uniform-photo');
        var change_signature = document.getElementById('uniform-sign');
        var delete_sign = document.getElementById('delete_sign');
        cancel_button.classList.remove('active-state');
        save_button.classList.remove('active-state');
        edit_button.classList.add('active-state');
        change_image.classList.remove('active-state')
        change_signature.classList.remove('active-state');
        delete_sign.classList.remove('active-state');
    }
    function hideTwoButtonImage(e){
        e.preventDefault()
        var edit_button  = document.getElementById('edit_button')
        var cancel_button = document.getElementById('cancel_button');
        var save_button = document.getElementById('save_button')
        var change_image = document.getElementById('uniform-photo');
        var change_signature = document.getElementById('uniform-sign');
        var delete_sign = document.getElementById('delete_sign');
        cancel_button.classList.add('active-state');
        save_button.classList.add('active-state');
        edit_button.classList.remove('active-state');
        change_image.classList.add('active-state')
        change_signature.classList.add('active-state');
        delete_sign.classList.add('active-state');
    }

</script>
