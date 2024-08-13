const menuItems = document.querySelectorAll('.menu-item');

const messagesNotification = document.querySelector('#messages-notifications');

const messages = document.querySelector('.messages');
const message = messages.querySelectorAll('.message');
const messageSearch = document.querySelector('#message-search');

const Bg = document.querySelector('.choose-color');
// const themeMenuItem = document.getElementById('theme');
// const themeLabel = themeMenuItem.querySelector('h3');
// const root = document.documentElement; // Reference to the root element for CSS variables

// let isDarkMode = false; // Flag to track theme mode

const root = document.documentElement; // Reference to the root element for CSS variables
const themeMenuItem = document.getElementById('theme');
const themeLabel = themeMenuItem.querySelector('h3');

let isDarkMode = root.getAttribute('data-theme') === 'dark'; // Check if the current theme is dark

// remove active class from all menu items
const changeActiveItem = () => {
    menuItems.forEach(item => {
        item.classList.remove('active');
    });
}

menuItems.forEach(item => {
    item.addEventListener('click', () => {
        changeActiveItem();
        item.classList.add('active');
        if (item.id != 'notifications') {
            document.querySelector('.notifications-popup').style.display = 'none';
        } else {
            document.querySelector('.notifications-popup').style.display = 'block';
            document.querySelector('#notifications .notification-count').style.display = 'none';
        }
    });
})

// ============================== MESSAGES ==============================
const searchMessage = () => {
    const val = messageSearch.value.toLowerCase();
    message.forEach(chat => {
        let name = chat.querySelector('h5').textContent.toLowerCase();
        if (name.indexOf(val) != -1) {
            chat.style.display = 'flex';
        } else {
            chat.style.display = 'none';
        }
    });
}

messageSearch.addEventListener('keyup', searchMessage);

messagesNotification.addEventListener('click', () => {
    messages.style.boxShadow = '0 0 1rem var(--color-primary)';
    messagesNotification.querySelector('.notification-count').style.display = 'none';
    setTimeout(() => {
        messages.style.boxShadow = 'none';
    }, 3000);
})

// THEME BACKGROUND
let lightColorLightness;
let whiteColorLightness;
let darkColorLightness;

const changeBG = () => {
    root.style.setProperty('--light-color-lightness', lightColorLightness);
    root.style.setProperty('--white-color-lightness', whiteColorLightness);
    root.style.setProperty('--dark-color-lightness', darkColorLightness);
}



// Function to apply the theme based on the isDarkMode flag
const applyTheme = () => {
    if (isDarkMode) {
        root.style.setProperty('--dark-color-lightness', '95%');
        root.style.setProperty('--white-color-lightness', '10%');
        root.style.setProperty('--light-color-lightness', '0%');
        themeLabel.textContent = 'Theme (Dark)';
    } else {
        root.style.setProperty('--dark-color-lightness', '0%');
        root.style.setProperty('--white-color-lightness', '100%');
        root.style.setProperty('--light-color-lightness', '95%');
        themeLabel.textContent = 'Theme (Light)';
    }
};

// Apply the theme on page load
applyTheme();

themeMenuItem.addEventListener('click', () => {
    isDarkMode = !isDarkMode; // Toggle the theme flag
    applyTheme();

    // Send an AJAX request to save the theme preference to the database
    fetch('save-theme.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ theme: isDarkMode ? 'dark' : 'light' }),
    });
});


// // Toggle theme mode
// themeMenuItem.addEventListener('click', () => {
//     if (isDarkMode) {
//         // Set to Light Mode
//         darkColorLightness = '0%';
//         whiteColorLightness = '100%';
//         lightColorLightness = '95%';
//         themeLabel.textContent = 'Theme (Light)';
//     } else {
//         // Set to Dark Mode
//         darkColorLightness = '95%';
//         whiteColorLightness = '10%';
//         lightColorLightness = '0%';
//         themeLabel.textContent = 'Theme (Dark)';
//     }

//     changeBG();
//     isDarkMode = !isDarkMode; // Toggle the flag
// });

// Toggle theme mode
// themeMenuItem.addEventListener('click', () => {
//     if (isDarkMode) {
//         // Set to Light Mode
//         darkColorLightness = '0%';
//         whiteColorLightness = '100%';
//         lightColorLightness = '95%';
//         themeLabel.textContent = 'Theme (Light)';
//         saveThemePreference('light');
//     } else {
//         // Set to Dark Mode
//         darkColorLightness = '95%';
//         whiteColorLightness = '10%';
//         lightColorLightness = '0%';
//         themeLabel.textContent = 'Theme (Dark)';
//         saveThemePreference('dark');
//     }

//     changeBG();
//     isDarkMode = !isDarkMode; // Toggle the flag
// });

// function saveThemePreference(theme) {
//     fetch('save_theme.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json'
//         },
//         body: JSON.stringify({ theme: theme })
//     })
//         .then(response => response.json())
//         .then(data => {
//             if (data.status === 'success') {
//                 console.log('Theme saved successfully.');
//             } else {
//                 console.error('Error saving theme:', data.message);
//             }
//         })
//         .catch(error => console.error('Error:', error));
// }

