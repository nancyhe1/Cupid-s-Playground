// Handle user choices
function chooseOption(choice) {
    const messages = document.getElementById("messages");
    const angel = document.getElementById("angel");
    const devil = document.getElementById("devil");
  
    // Add user's choice to the messages
    const userMessage = document.createElement("p");
    userMessage.className = "message user";
    userMessage.textContent = `You chose: ${choice}`;
    messages.appendChild(userMessage);
  
    // Simulate angel/devil reaction
    if (choice === "yes") {
      angel.style.left = "10px"; // Move angel in
      devil.style.right = "-60px"; // Move devil out
      playAngelEffect();
    } else {
      devil.style.right = "10px"; // Move devil in
      angel.style.left = "-60px"; // Move angel out
      playDevilEffect();
    }
  }
  
  // Play angel effect
  function playAngelEffect() {
    console.log("Play angel sound/effect"); // Replace with audio/sound effect
  }
  
  // Play devil effect
  function playDevilEffect() {
    console.log("Play devil sound/effect"); // Replace with audio/sound effect
  }
  