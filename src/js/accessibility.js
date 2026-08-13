const accessibility = {
  state: {
    theme: 'norm',
    fontSize: 100,
    font: 'sans',
    kerning: 0,      // 0 (обычный)
    lineHeight: 1.5, // 1.5 (стандартный)
    hideImages: false,
    isOpen: false
  },
  storeKey: undefined,

  init() {
    const prefix = process.env.PREFIX || "store";
    const version = process.env.VERSION || "1.0";
    this.storeKey = `${prefix}_v${version.replaceAll('.', '_')}`;

    const saved = localStorage.getItem(this.storeKey);
    if (saved) {
      try { this.state = { ...this.state, ...JSON.parse(saved) }; } catch(e){}
    }

    // Защита от старых текстовых значений
    if (typeof this.state.lineHeight !== 'number') {
      this.state.lineHeight = parseFloat(this.state.lineHeight) || 1.5;
    }
    if (typeof this.state.kerning !== 'number') {
      this.state.kerning = parseFloat(this.state.kerning) || 0;
    }

    // Темы
    const themes = ['norm', 'b', 'ch', 'g', 'k'];
    themes.forEach(t => {
      const btn = document.getElementById(`hosta11y-btn-theme-${t}`);
      if (btn) btn.addEventListener('click', () => this.setTheme(t));
    });

    // Размер шрифта
    document.getElementById('hosta11y-btn-font-size-dec')?.addEventListener('click', () => this.changeFontSize(-10));
    document.getElementById('hosta11y-btn-font-size-inc')?.addEventListener('click', () => this.changeFontSize(10));

    // Шрифт (Засечки)
    document.getElementById('hosta11y-btn-font-sans')?.addEventListener('click', () => this.setFont('sans'));
    document.getElementById('hosta11y-btn-font-serif')?.addEventListener('click', () => this.setFont('serif'));

    // Кернинг
    document.getElementById('hosta11y-btn-kerning-dec')?.addEventListener('click', () => this.changeKerning(-0.05));
    document.getElementById('hosta11y-btn-kerning-inc')?.addEventListener('click', () => this.changeKerning(0.05));

    // Межстрочный интервал
    document.getElementById('hosta11y-btn-line-height-dec')?.addEventListener('click', () => this.changeLineHeight(-0.2));
    document.getElementById('hosta11y-btn-line-height-inc')?.addEventListener('click', () => this.changeLineHeight(0.2));

    // Изображения
    document.getElementById('hosta11y-btn-toggle-img')?.addEventListener('click', () => this.toggleImages());

    document.addEventListener('keydown', (event) => {

      if (event.key === 'Escape' && this.state.isOpen) {
        this.togglePanel();
      }
    });


    const toggleBtn = document.getElementById('hosta11y-toggle-btn');
    toggleBtn?.addEventListener('click', () => this.togglePanel());

    document.addEventListener('click', (event) => {
      if (!document.getElementById('hosta11y-panel').contains(event.target) && !toggleBtn.contains(event.target) && this.state.isOpen) {
        this.togglePanel();
      }
    });

    this.apply();
  },

  togglePanel() {
    this.state.isOpen = !this.state.isOpen;
    this.save();
    const panel = document.getElementById('hosta11y-panel');
    panel.classList.toggle('hosta11y-hidden');
    const firstBtn = panel.querySelector('button');
    console.log(firstBtn);
    firstBtn.focus();
  },

  save() {
    localStorage.setItem(this.storeKey, JSON.stringify(this.state));
    this.apply();
  },

  setTheme(theme) {
    if (theme === 'norm') {
      // Сбрасываем все настройки к значениям по умолчанию
      this.state = {
        theme: 'norm',
        fontSize: 100,
        font: 'sans',
        kerning: 0,
        lineHeight: 1.5,
        hideImages: false,
        isOpen: this.state.isOpen // сохраняем текущий статус открытости панели
      };
    } else {
      this.state.theme = theme;
    }
    this.save();
  },

  changeFontSize(delta) {
    this.state.fontSize = Math.max(70, Math.min(200, this.state.fontSize + delta));
    this.save();
  },

  setFont(font) {
    this.state.font = font;
    this.save();
  },

  changeKerning(delta) {
    const current = parseFloat(this.state.kerning) || 0;
    const newVal = parseFloat((current + delta).toFixed(2));
    this.state.kerning = Math.max(0, Math.min(0.5, newVal));
    this.save();
  },

  changeLineHeight(delta) {
    const current = parseFloat(this.state.lineHeight) || 1.5;
    const newVal = parseFloat((current + delta).toFixed(1));
    this.state.lineHeight = Math.max(1.0, Math.min(3.0, newVal));
    this.save();
  },

  toggleImages() {
    this.state.hideImages = !this.state.hideImages;
    this.save();
  },

  highlightActiveButtons() {
    // Удаляем активный класс со всех кнопок панели
    document.querySelectorAll('#hosta11y-panel .hosta11y-btn').forEach(btn => {
      btn.classList.remove('hosta11y-btn-active');
    });

    // Активная тема
    const activeThemeBtn = document.getElementById(`hosta11y-btn-theme-${this.state.theme}`);
    if (activeThemeBtn) activeThemeBtn.classList.add('hosta11y-btn-active');

    // Активный шрифт
    const activeFontBtn = document.getElementById(`hosta11y-btn-font-${this.state.font}`);
    if (activeFontBtn) activeFontBtn.classList.add('hosta11y-btn-active');

    // Активная кнопка скрытия фото
    if (this.state.hideImages) {
      const imgBtn = document.getElementById('hosta11y-btn-toggle-img');
      if (imgBtn) imgBtn.classList.add('hosta11y-btn-active');
    }
  },

  apply() {
    const html = document.documentElement;

    // 1. Темы
    html.classList.remove('hosta11y-theme-norm', 'hosta11y-theme-b', 'hosta11y-theme-ch', 'hosta11y-theme-g', 'hosta11y-theme-k');
    html.classList.add('hosta11y-theme-' + this.state.theme);

    // 2. Размер шрифта
    if (this.state.fontSize === 100) {
      document.body.style.removeProperty('font-size');
    } else {
      document.body.style.fontSize = this.state.fontSize + '%';
    }

    // 3. Шрифт
    html.classList.remove('hosta11y-font-serif', 'hosta11y-font-sans');
    html.classList.add('hosta11y-font-' + this.state.font);

    // 4. Динамический Кернинг и Интервал (через CSS переменные)
    if (this.state.theme === 'norm' && this.state.kerning === 0 && this.state.lineHeight === 1.5) {
      html.style.removeProperty('--hosta11y-letter-spacing');
      html.style.removeProperty('--hosta11y-line-height');
    } else {
      html.style.setProperty('--hosta11y-letter-spacing', this.state.kerning + 'em');
      html.style.setProperty('--hosta11y-line-height', this.state.lineHeight);
    }

    // 5. Скрытие фото
    html.classList.toggle('hosta11y-hide-images', this.state.hideImages);

    // 6. Обводка активных кнопок
    this.highlightActiveButtons();
  }
}

export default accessibility;