export default {
  getData: async (url) => {
    const response = await fetch(url, {
      header: {
        "Content-Type": "application/json",
      },
    });
    return response.json();
  },
  storeData: async (url, config) => {
    const response = await fetch(url, config);
    return response.json();
  },
  successMsg: (message) => {
    iziToast.success({
      message: message,
      position: "topRight",
    });
  },
  errorMsg: (message) => {
    iziToast.error({
      message: message,
      position: "topRight",
    });
  },
  warningMsg: (message) => {
    iziToast.warning({
      message: message,
      position: "topRight",
    });
  },
  setConfig: (method, cors = "no-cors", headers = {}, body = {}) => {
    const config = {
      method: method,
      cors: cors,
      headers: headers,
      body: body,
    };
    return config;
  },
  formatRupiah: (money) => {
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR",
      minimumFractionDigits: 0,
    }).format(money);
  },
  getTotal: async function(url, el, title = "Total Transaksi") {
    this.getData(url).then((res) => {
      const total = document.querySelector(el);
      return (total.innerText = `${title} : ${this.formatRupiah(res.total)}`);
    });
  },
  reloadDataTabel: (el) => {
    $(el)
      .DataTable()
      .ajax.reload();
  },
  reloadForm: (elForm, elSelect2 = "") => {
    if (elSelect2 !== "") {
      $(".select2")
        .val(null)
        .trigger("change");
    }
    document.querySelector(elForm).reset();
  },
  inputRupiah: (number) => {
    let number_string = number.replace(/[^,\d]/g, "").toString(),
      split = number_string.split(","),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
      let separator = sisa ? "." : "";
      rupiah += separator + ribuan.join(".");
    }
    return (rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah);
  },
  removeDot: (number) => {
    return number.replace(/[ ,.]/g, "");
  },
};
