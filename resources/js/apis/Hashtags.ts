import axios from "axios";

async function getHashtags() {
    try {
        const res = await axios.get(
            // `https://jubel-acursio.store/api/hashtags/`,
            `http://127.0.0.1:8000/api/hashtags/`,
            {
                params: {
                    limit: 10000000,
                },
            }
        );

        return res.data.result;
    } catch (error) {
        console.error("Error fetching account:", error);
        throw error;
    }
}

export { getHashtags };
