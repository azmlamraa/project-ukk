function tambahProduk() {

    const container =
        document.getElementById("produk-container");

    const rows =
        container.querySelectorAll(".produk-row");

    if (rows.length === 0) {
        return;
    }

    const row =
        rows[0].cloneNode(true);

    row.querySelectorAll("input").forEach(function(input) {
        input.value = 1;
    });

    row.querySelectorAll("select").forEach(function(select) {
        select.selectedIndex = 0;
    });

    container.appendChild(row);
}