const getBaseUrl = () => {
    const pathArray = location.href.split("/");
    const protocol = pathArray[0];
    const host = pathArray[2];
    const url = protocol + "//" + host + "/";
    return url;
};

const axiosClient = axios.create({
    baseURL: getBaseUrl(),
    headers: {
        accept: "application/json",
        "content-type": "application/json",
    },
});

axiosClient.interceptors.response.use(
    (response) => {
        if (response && response.data) {
            return response.data;
        }
        return response;
    },
    (error) => {
        throw error;
    }
);

$(".shop-item-button").on("click", function (e) {
    const id = parseInt($(this).data("id"));

    axiosClient
        .post("add-cart", { id })
        .then((res) => {
            if (res.status === "SUCCESS") {
                location.reload();
            }
        })
        .catch((err) => console.log(err));
});

$(".cart-item-remove").on("click", function (e) {
    const id = parseInt($(this).data("id"));

    axiosClient
        .post("delete-cart", { id })
        .then((res) => {
            if (res.status === "SUCCESS") {
                location.reload();
            }
        })
        .catch((err) => console.log(err));
});

const handleUpdateQuantity = (id, type) => {
    axiosClient
        .post("update-cart", { id, type })
        .then((res) => {
            if (res.status === "SUCCESS") {
                location.reload();
            }
        })
        .catch((err) => console.log(err));
};

$(".cart-item-count-button.add").on("click", function (e) {
    const id = parseInt($(this).data("id"));
    handleUpdateQuantity(id, "ADD");
});

$(".cart-item-count-button.sub").on("click", function (e) {
    const id = parseInt($(this).data("id"));
    handleUpdateQuantity(id, "SUB");
});
