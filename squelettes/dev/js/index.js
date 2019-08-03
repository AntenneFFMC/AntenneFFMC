import '../sass/index.scss';
import DOMscan from './components/DOMscan';

class App {
  constructor () {
    this.initApp();
  }
  initApp () {
    this.DOMscan = new DOMscan();
  }
}

new App();
