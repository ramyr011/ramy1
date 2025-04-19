document.addEventListener("DOMContentLoaded", function () {
              const serviceCards = document.querySelectorAll(".service-card");
          
              serviceCards.forEach(card => {
                  card.addEventListener("click", function () {
                      // إزالة التحديد من كل البطاقات
                      serviceCards.forEach(c => c.classList.remove("active"));
          
                      // إضافة التحديد إلى البطاقة المحددة
                      this.classList.add("active");
          
                      // عرض تفاصيل إضافية
                      const details = document.createElement("p");
                      details.classList.add("service-details");
                      details.innerText = "تفاصيل إضافية عن الخدمة...";
                      
                      // إزالة أي تفاصيل سابقة وإضافة الجديدة
                      const existingDetails = this.querySelector(".service-details");
                      if (existingDetails) {
                          existingDetails.remove();
                      } else {
                          this.appendChild(details);
                      }
                  });
              });
          });
          