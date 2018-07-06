<script type="text/javascript">
$(document).ready(function() {      
	$(".popconfirm-update").popConfirm({
        title: "Apakah anda yakin?", // The title of the confirm
        content: "Perubahan tidak dapat dikembalikan.", // The message of the confirm
        placement: "right", // The placement of the confirm (Top, Right, Bottom, Left)
        yesBtn: "<i class='fa fa-save'></i> Simpan",
        noBtn: "<i class='icon-close'></i> Batal",
        classYesBtn: "btn-info"
    });

    $(".popconfirm-add").popConfirm({
        title: "Anda yakin?", // The title of the confirm
        content: "", // The message of the confirm
        placement: "right", // The placement of the confirm (Top, Right, Bottom, Left)
        yesBtn: "<i class='fa fa-save'></i> Simpan",
        noBtn: "<i class='icon-close'></i> Batal",
        classYesBtn: "btn-info"
    });	

	$(".popconfirm-konfirm").popConfirm({
        title: "Anda yakin?", // The title of the confirm
        content: "Konfirmasi Pengajuan tidak dapat diulang", // The message of the confirm
        placement: "right", // The placement of the confirm (Top, Right, Bottom, Left)
        yesBtn: "<i class='fa fa-check'></i> Konfirmasi",
        noBtn: "<i class='icon-close'></i> Batal",
        classYesBtn: "btn-info"
    });     

    $(".popconfirm-pakai").popConfirm({
        title: "Anda yakin?", // The title of the confirm
        content: "Pemakaian Inventori tidak dapat diubah", // The message of the confirm
        placement: "right", // The placement of the confirm (Top, Right, Bottom, Left)
        yesBtn: "<i class='fa fa-check'></i> Pakai",
        noBtn: "<i class='icon-close'></i> Batal",
        classYesBtn: "btn-info"
    }); 
});
</script>