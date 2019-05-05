 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <title>CKFinder 3</title>
     <script src="ckfinder/ckfinder.js"></script>
 </head>
 <body>
     <script>
         function openPopup() {
             CKFinder.popup( {
                 chooseFiles: true,
                 onInit: function( finder ) {
                     finder.on( 'files:choose', function( evt ) {
                         var file = evt.data.files.first();
                         document.getElementById( 'url' ).value = file.getUrl();
                     } );
                     finder.on( 'file:choose:resizedImage', function( evt ) {
                         document.getElementById( 'url' ).value = evt.data.resizedUrl;
                     } );
                 }
             } );
         }
     </script>
     <input type="text" size="48" name="url" id="url" /> <button onclick="openPopup()">Select file</button>
 </body>
 </html>