import '../sass/index.scss';
import HomeWidget from './components/HomeWidget';

class App {
  constructor () {
    this.initApp();
  }
  initApp () {
    this.HomeWidget = new HomeWidget();
  }
}

new App();
