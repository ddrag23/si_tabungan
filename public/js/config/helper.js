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
      return (total.innerText = `${title} : Rp. ${this.formatRupiah(
        res.total
      )}`);
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
};
