<script type="text/javascript">
  function DropDownChanged(oDDL) {
    var oTextbox = oDDL.form.elements["nama_inven_txt"];
    if (oTextbox) {
        oTextbox.style.display = (oDDL.value == "nn") ? "" : "none";
        if (oDDL.value == "nn")
            oTextbox.focus();
    }
  }

  function FormSubmit(oForm) {
      var oHidden = oForm.elements["id_inven"];
      var oDDL = oForm.elements["nama_inven"];
      var oTextbox = oForm.elements["nama_inven_txt"];
      if (oHidden && oDDL && oTextbox)
          oHidden.value = (oDDL.value == "") ? oTextbox.value : oDDL.value;
  }

</script>