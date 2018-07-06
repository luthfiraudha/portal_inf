<script type="text/javascript">
        $(document).ready(function() {

        $('#summernotes').summernote({
        toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert',['picture','link']]
              ],
              disableDragAndDrop: true,
              height: 200      
          
      
            });

        });  

      

        var postForm = function() {
            var content = $('textarea[name="text"]').html($('#summernote').code());
        }

       

	    function edit(id) {
          $('.click2edit'+id).summernote({focus: true,
          height: 100,
          toolbar: false,
          placeholder: 'type with shift and content..',
          hint: {
            words: ['shift 1 :', 'shift 2 :', 'shift 3 :'],
            match: /\b(\w{1,})$/,
            search: function (keyword, callback) {
              callback($.grep(this.words, function (item) {
                return item.indexOf(keyword) === 0;
              }));
            }
          }
          });
          document.getElementById('save'+id).style.display='block';
          document.getElementById('edit'+id).style.display='none';
          console.log('.click2edit'+id);
        };

        function save(id) {
            var makrup = $('.click2edit'+id).summernote('code');
            var text_id = id;  
            var text = $('.click2edit'+id).summernote('code');

            $.ajax({
              url: "<?php echo site_url('dashboard/edit_note/'); ?>",
              type: "POST",
              data: {
                'text_id': text_id, 'text': text
                },  
              cache: false,
              success: function(url){
               
                console.log(url);
              }
            });
            document.getElementById('save'+id).style.display='none';
            document.getElementById('edit'+id).style.display='block';

          $('.click2edit'+id).summernote('destroy');
           console.log(text_id);
        };

</script>