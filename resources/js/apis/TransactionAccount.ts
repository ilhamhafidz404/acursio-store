import axios from "axios";

async function showTransactionAccount(invoice: string) {
    try {
        const res = await axios.get(
            `http://127.0.0.1:8000/api/transactionAccounts/${invoice}`
        );

        console.log(res.data.result);
        return res.data.result;
    } catch (error) {
        console.error("Error fetching account:", error);
        throw error;
    }
}

export { showTransactionAccount };
