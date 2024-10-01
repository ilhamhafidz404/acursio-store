export default function formatRank(rank) {
    const romanMap = {
        1: "I",
        2: "II",
        3: "III",
        4: "IV",
        5: "V",
    };

    return rank
        .replace(/\b\w/g, (char) => char.toUpperCase()) // Mengubah huruf pertama setiap kata menjadi uppercase
        .replace(/-/g, " ") // Mengganti tanda '-' dengan spasi
        .replace(/\d/g, (digit) => romanMap[digit] || digit); // Mengganti angka dengan angka Romawi, jika ada
}
