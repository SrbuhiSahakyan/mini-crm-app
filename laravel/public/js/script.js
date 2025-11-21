document.addEventListener("DOMContentLoaded", function () {
    const apiMeta = document.querySelector('meta[name="api-base-url"]');
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const apiBaseUrl = apiMeta.content;
    const csrfToken = csrfMeta.content;
    async function loadTicketStatistics() {
        try {
            const response = await fetch(`${apiBaseUrl}/tickets/statistics`, {
                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
            });
            const data = await response.json();
            document.getElementById("tickets-day").textContent = data.day ?? 0;
            document.getElementById("tickets-week").textContent =
                data.week ?? 0;
            document.getElementById("tickets-month").textContent =
                data.month ?? 0;
        } catch (error) {
            console.error("Не удалось загрузить статистику тикетов:", error);
        }
    }
    loadTicketStatistics();
});
