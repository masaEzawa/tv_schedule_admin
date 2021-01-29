tinymce.init({
    selector: "#tinymce", // id="tinymce"の場所にTinyMCEを適用
    language: "ja", // 言語 = 日本語
    height: 700,
    // plugins  : 'link autolink preview',
    //plugins: [ 'code', 'lists' ],
    plugins: [
	    'advlist autolink lists link image charmap print preview anchor pagebreak',
	    'searchreplace visualblocks code fullscreen',
	    'insertdatetime media table contextmenu paste code',
	    'textcolor hr emoticons'
    ],
    color_map: [
      "000000", "Black",
      "993300", "Burnt orange",
      "333300", "Dark olive",
      "003300", "Dark green",
      "003366", "Dark azure",
      "000080", "Navy Blue",
      "333399", "Indigo",
      "333333", "Very dark gray",
      "800000", "Maroon",
      "FF6600", "Orange",
      "808000", "Olive",
      "008000", "Green",
      "008080", "Teal",
      "0000FF", "Blue",
      "666699", "Grayish blue",
      "808080", "Gray",
      "FF0000", "Red",
      "FF9900", "Amber",
      "99CC00", "Yellow green",
      "339966", "Sea green",
      "33CCCC", "Turquoise",
      "3366FF", "Royal blue",
      "800080", "Purple",
      "999999", "Medium gray",
      "FF00FF", "Magenta",
      "FFCC00", "Gold",
      "FFFF00", "Yellow",
      "00FF00", "Lime",
      "00FFFF", "Aqua",
      "00CCFF", "Sky blue",
      "993366", "Red violet",
      "FFFFFF", "White",
      "FF99CC", "Pink",
      "FFCC99", "Peach",
      "FFFF99", "Light yellow",
      "CCFFCC", "Pale green",
      "CCFFFF", "Pale cyan",
      "99CCFF", "Light sky blue",
      "CC99FF", "Plum"
    ],
    toolbar1: 'bold italic underline strikethrough hr | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent',
    toolbar2: 'forecolor backcolor | link unlink image | table | pagebreak | undo redo | searchreplace | fullscreen | code emoticons',
    toolbar3: 'styleselect formatselect fontselect fontsizeselect |',
  
    mobile: {
	    theme: 'mobile',
	    plugins: [ 'autosave', 'lists', 'autolink', 'textcolor' ],
      toolbar: [ 'bold', 'italic', 'styleselect', 'forecolor', 'backcolor' ]
	  },
    menubar  : false,
    relative_urls : false,
    branding: false, // クレジットの削除
    init_instance_callback: function (editor) {
      editor.on('blur', function (e) {
        console.log('Editor was blurred!');
      });
    }
});