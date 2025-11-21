document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("widgetForm");
    if (!form) return;
    const BASE_URL =
        document.querySelector('meta[name="csrf-token"]').dataset.baseUrl ||
        document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
    const resultDiv = document.getElementById("result");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        document
            .querySelectorAll(".error")
            .forEach((el) => (el.innerText = ""));
        resultDiv.style.display = "none";
        resultDiv.innerText = "";
        const fd = new FormData(form);
        try {
            const res = await fetch("/api/tickets", {
                method: "POST",
                body: fd,
                headers: { Accept: "application/json" },
            });

            let data = {};
            try {
                data = await res.json();
            } catch {}

            if (!res.ok) {
                if (data.errors) {
                    Object.entries(data.errors).forEach(([field, messages]) => {
                        const base = field.split(".")[0];
                        const errorDiv = document.querySelector(
                            `.error[data-field="${base}"]`
                        );
                        if (errorDiv) errorDiv.innerText = messages.join(", ");
                    });
                } else {
                    resultDiv.innerText = data.message || "Ошибка";
                    resultDiv.style.display = "flex";
                }
                return;
            }
            resultDiv.innerText = "Спасибо! Ваша заявка принята";
            resultDiv.style.display = "flex";
            form.reset();
        } catch (err) {
            console.error(err);
            resultDiv.innerText = "Ошибка отправки";
            resultDiv.style.display = "flex";
        }
    });
});
