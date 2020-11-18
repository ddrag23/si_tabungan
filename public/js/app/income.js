import Config from "../config/config.js";
import Helper from "../config/helper.js";

// variabel
const selectName = document.getElementById("user_id");
const nominal = document.getElementById("nominal");
const submit = document.getElementById("form-income");
const tokenCsrf = {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
};
// end

// jquery code
$(function() {
    $(".select2").select2({
        dropdownParent: $("#exampleModal")
    });
    $("#table").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengtChange: true,
        autoWidth: false,
        ajax: {
            url: `${Config.url}/transaksi/transaksi-masuk/json-data`
        },
        columns: [
            { data: "DT_RowIndex", name: "no" },
            { data: "name", name: "name" },
            { data: "nominal", name: "nominal" },
            { data: "created_at", name: "created_at" },
            { data: "action", name: "action" }
        ]
    });
});
// jquer code end

// vanilla js
const handleTotal = async () => {
    const urlTotal = `${Config.url}/transaksi/transaksi-masuk/json-total`;
    Helper.getData(urlTotal).then(res => {
        const total = document.querySelector(".total");
        total.innerText = `Total Transaksi : Rp. ${Helper.formatRupiah(
            res.total
        )}`;
    });
};
const handleReload = () => {
    $("#table")
        .DataTable()
        .ajax.reload();
};

const handleValidate = () => {
    if (selectName.value == "") {
        selectName.classList.add("border-danger");
        selectName.focus();
    }
    if (nominal.value == "") {
        nominal.classList.add("border-danger");
        nominal.focus();
    }
};

const handleSubmit = e => {
    e.preventDefault();
    const formData = new FormData();
    formData.append("user_id", selectName.value);
    formData.append("nominal", nominal.value);

    Helper.storeData(
        `${Config.url}/transaksi/transaksi-masuk/store`,
        Helper.setConfig("POST", "cors", tokenCsrf, formData)
    )
        .then(res => {
            // console.log(res);
            if (res.success) {
                $(".select2")
                    .val(null)
                    .trigger("change");
                submit.reset();
                handleReload();
                handleTotal();
                Helper.successMsg(res.message);
                $("#exampleModal").modal("hide");
            } else {
                for (let index in res.message) {
                    Helper.errorMsg(res.message[index]);
                    handleValidate();
                }
            }
        })
        .catch(err => {
            Helper.errorMsg(err);
        });
};

const handleDelete = e => {
    if (e.target.classList.contains("delete")) {
        const id = e.target.dataset.id;
        const urlDelete = `${
            Config.url
        }/transaksi/transaksi-masuk/delete/${parseInt(id)}`;
        swal({
            title: "Apakah Kamu Yakin ?",
            text: "Setelah dihapus anda tidak dapat memulihkan data ini!",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(willDelete => {
            if (willDelete) {
                Helper.storeData(
                    urlDelete,
                    Helper.setConfig("DELETE", "cors", tokenCsrf)
                )
                    .then(res => {
                        handleReload();
                        handleTotal();
                        Helper.successMsg(res.message);
                    })
                    .catch(err => Helper.errorMsg(err));
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    }
};

submit.addEventListener("submit", handleSubmit);
document.addEventListener("click", handleDelete);
window.onload = handleTotal;
// vanilla js end
