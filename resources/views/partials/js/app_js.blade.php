<script>
    (function(EmailsInput, random) {
  'use strict'

  document.addEventListener('DOMContentLoaded', function() {
    const inputContainerNode = document.querySelector('#emails-input')
    const emailsInput = EmailsInput(inputContainerNode)

    // expose instance for quick access in playground
    window.emailsInput = emailsInput

    document.querySelector('[data-action="add-email"]')
      .addEventListener('click', function() { emailsInput.add(random.email()) })

    document.querySelector('[data-action="get-emails-count"]')
      .addEventListener('click', function() {
        const emails = emailsInput.getValue()
        alert('there are ' + emails.length + ' valid email(s)')
      })
  })

}(window.lib.EmailsInput, window.lib.utils.random))
// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
//     },
// });
// function updateMessageState(){
//     let form = new FormData();
//     form.append("messageID", id);
//     alert(id)
//     var ajaxOptions = {
//         url: 'updateMessageState',
//         type: 'POST',
//         cache: false,
//         processData: false,
//         dataType: 'json',
//         contentType: false,
//         data: form,
//     }
//     var req = $.ajax(ajaxOptions);
//     req.done(function(resp){
//         console.log(resp);
//     }).fail(function(e){
//         console.error(e);
//         return e.status;
//     })

// }

</script>
