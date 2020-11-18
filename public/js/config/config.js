export default {
    url: "http://127.0.0.1:8000",
    tokenCsrf: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
};
