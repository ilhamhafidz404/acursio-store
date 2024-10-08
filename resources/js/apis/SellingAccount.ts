import axios from "axios";

async function getSellingAccountById(id: number) {
    try {
        const res = await axios.get(
            `http://127.0.0.1:8000/api/sellingAccounts/${id}`
        );

        return res.data.result;
    } catch (error) {
        console.error("Error fetching account:", error);
        throw error;
    }
}

export { getSellingAccountById };
