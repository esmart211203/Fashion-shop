const bar = document.getElementById("bar");
const close = document.getElementById("close");
const nav = document.getElementById("navbar");

if (bar) {
    bar.addEventListener("click", () => {
        nav.classList.add("active");
    });
}
if (close) {
    close.addEventListener("click", () => {
        nav.classList.remove("active");
    });
}

var MainImg = document.getElementById("MainImg");
var smallimg = document.getElementsByClassName("small-img");

for (var i = 0; i < smallimg.length; i++) {
    smallimg[i].onclick = function () {
        MainImg.src = this.src;
    };
}

// Lấy danh sách các phần tử li trong menu
const menuItems = document.querySelectorAll("#navbar li");

// Lặp qua từng phần tử li và gán sự kiện click
menuItems.forEach((item) => {
    item.addEventListener("click", function () {
        // Loại bỏ lớp "active" khỏi tất cả các phần tử li
        menuItems.forEach((item) => {
            item.querySelector("a").classList.remove("active");
        });

        // Thêm lớp "active" cho phần tử li được click
        this.querySelector("a").classList.add("active");
    });
});
