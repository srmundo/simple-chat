export function setLocalStorage(name, worth){
    let local = window.sessionStorage.setItem(name, JSON.stringify(worth));
}


