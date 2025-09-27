// Mobile drawer toggles
      const mobileToggle = document.getElementById("mobileToggle");
      const mobileDrawer = document.getElementById("mobileDrawer");
      const mobileClose = document.getElementById("mobileClose");

      mobileToggle.addEventListener("click", () => {
        mobileDrawer.style.display = "block";
        mobileDrawer.setAttribute("aria-hidden", "false");
      });
      mobileClose.addEventListener("click", () => {
        mobileDrawer.style.display = "none";
        mobileDrawer.setAttribute("aria-hidden", "true");
      });

      // slider: cycle slides every 4s
      (function slider() {
        const sliderEl = document.getElementById("slider");
        if (!sliderEl) return;
        let idx = 0;
        const slides = sliderEl.querySelectorAll(".slide");
        const total = slides.length;
        slides.forEach((s, i) => (s.style.opacity = i === 0 ? "1" : "0"));

        setInterval(() => {
          slides[idx].style.opacity = "0";
          idx = (idx + 1) % total;
          slides[idx].style.opacity = "1";
        }, 4000);
      })();