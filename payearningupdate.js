// @ts-nocheck
/**
 * Pay Earning Update Module
 * Handles loan payment calculations, field visibility, and loan progress bar
 */

// Constants
const LOAN_TYPES = {
  SSS_LOAN: "sssloan",
  SSS_CALAMITY: "ssscalamity",
  PAGIBIG_LOAN: "pagibigloan",
  PAGIBIG_CALAMITY: "pagibigcalamity",
};

const PAYMENT_METHODS = {
  MONTHLY: 1,
  SEMI_MONTHLY: 2,
  LUMP_SUM: 3,
};

const INTEREST_RATES = {
  ONE_YEAR: 0.09,
  ONE_HALF_YEAR: 0.135,
  TWO_YEAR: 0.18,
  MONTHLY_RATE: 0.0075,
};

const BANKS = {
  NEXT_BANK: "NextBank",
  BADA1: "BADA1",
  BADA2: "BADA2",
};

// Utility Functions
const DOMUtils = {
  getElement: (selector) => $(selector),
  getValue: (selector) => $(selector).val(),
  setValue: (selector, value) => $(selector).val(value),
  toggleElement: (selector, show, required = false) => {
    $(selector).css("display", show ? "" : "none");
    $(selector).prop("required", required && show);
  },
};

const DateUtils = {
  parseFlexibleDate: (dateString) => {
    if (!dateString) return null;

    if (/^\d{4}-\d{2}-\d{2}$/.test(dateString)) {
      const parts = dateString.split("-");
      const yy = parseInt(parts[0], 10);
      const mm = parseInt(parts[1], 10) - 1;
      const dd = parseInt(parts[2], 10);
      const d = new Date(yy, mm, dd);
      return isNaN(d) ? null : d;
    }

    const mdy = dateString.match(/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/);
    if (mdy) {
      const mm = parseInt(mdy[1], 10) - 1;
      const dd = parseInt(mdy[2], 10);
      const yy = parseInt(mdy[3], 10);
      const d = new Date(yy, mm, dd);
      return isNaN(d) ? null : d;
    }

    const d = new Date(dateString);
    return isNaN(d) ? null : d;
  },

  addYears: (dateString, years) => {
    const date = DateUtils.parseFlexibleDate(dateString);
    if (!date) return null;

    const monthsToAdd = Math.round(years * 12);
    const originalDay = date.getDate();

    const result = new Date(date);
    const currentMonth = result.getMonth();
    const currentYear = result.getFullYear();

    const totalMonths = currentMonth + monthsToAdd;
    const newYear = currentYear + Math.floor(totalMonths / 12);
    const newMonth = totalMonths % 12;

    result.setDate(1);
    result.setFullYear(newYear);
    result.setMonth(newMonth);

    const lastDayOfTargetMonth = new Date(newYear, newMonth + 1, 0).getDate();
    result.setDate(Math.min(originalDay, lastDayOfTargetMonth));

    return result;
  },

  getMonthsDifference: (startDate, endDate) => {
    const yearsDiff = endDate.getFullYear() - startDate.getFullYear();
    let monthsDiff = endDate.getMonth() - startDate.getMonth();

    if (monthsDiff < 0) {
      monthsDiff += 12;
      return (yearsDiff - 1) * 12 + monthsDiff;
    }
    return yearsDiff * 12 + monthsDiff;
  },
};

// Debounce utility
const debounce = (func, wait) => {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
};

// ─────────────────────────────────────────────
// Loan Payment Manager (SSS/Pagibig blocks)
// ─────────────────────────────────────────────
class LoanPaymentManager {
  constructor(config) {
    this.paymentSelector = config.paymentSelector;
    this.containerClass  = config.containerClass;
    this.option1Class    = config.option1Class;
    this.option2Class    = config.option2Class;
    this.radioClass      = config.radioClass;
    this.dateSelector    = config.dateSelector;
    // this.cutoffSelector  = config.cutoffSelector;
    this.cutoffName = config.cutoffName; // LOAN LOGIC
  }

  initialize() {
    const paymentValue = DOMUtils.getValue(this.paymentSelector);
    this.updateVisibility(paymentValue);
    this.determineCutoff();
    this.attachEventListeners();
  }

  updateVisibility(paymentValue) {
    const value = parseInt(paymentValue);

    if (value > 0) {
      DOMUtils.toggleElement(`.${this.containerClass}`, true, true);
    } else {
      DOMUtils.toggleElement(`.${this.containerClass}`, false);
      DOMUtils.toggleElement(`.${this.option1Class}`, false);
      DOMUtils.toggleElement(`.${this.option2Class}`, false);
      if (this.radioClass) DOMUtils.toggleElement(`.${this.radioClass}`, false);
      return;
    }

    if (this.radioClass) {
      DOMUtils.toggleElement(
        `.${this.radioClass}`,
        value === PAYMENT_METHODS.MONTHLY,
        value === PAYMENT_METHODS.MONTHLY
      );
    }

    if (value === PAYMENT_METHODS.SEMI_MONTHLY) {
      DOMUtils.toggleElement(`.${this.option2Class}`, true, true);
      DOMUtils.toggleElement(`.${this.option1Class}`, false);
    } else if (value === PAYMENT_METHODS.MONTHLY) {
      DOMUtils.toggleElement(`.${this.option1Class}`, true, true);
      DOMUtils.toggleElement(`.${this.option2Class}`, false);
    }
  }

// LOAN LOGIC
determineCutoff() {
    if (!this.dateSelector || !this.cutoffName) return;
    const dateStr = DOMUtils.getValue(this.dateSelector);
    if (!dateStr) return;
    const date = DateUtils.parseFlexibleDate(dateStr);
    if (!date) return;
    const cutoff = date.getDate() <= 15 ? 'Firstcutoff' : 'Lastcutoff';
    $(`input[name="${this.cutoffName}"][value="${cutoff}"]`).prop('checked', true);
}

  attachEventListeners() {
    $(this.paymentSelector).on("change", () => {
      const paymentValue = DOMUtils.getValue(this.paymentSelector);
      this.updateVisibility(paymentValue);
    });

    if (this.dateSelector) {
      $(this.dateSelector).on("change", () => {
        this.determineCutoff();
      });
    }
  }
} // end LoanPaymentManager

// ─────────────────────────────────────────────
// Salary Loan Calculator
// ─────────────────────────────────────────────
class SalaryLoanCalculator {
  constructor() {
    this.selectors = {
      loan:              "#salaryloan",
      bank:              "#slBank",
      payment:           "#slPayment",
      year:              "#slyear",
      date:              "#slDate",
      dueDate:           "#slDuedate",
      amortization:      "#slAmortization",
      amortizationFirst: "#slAmortizationfirst",
      amortizationLast:  "#slAmortizationlast",
      balance:           "#slBalance",
      interest:          "#interest",
      principal:         "#principal",
      progressBar:       "#loanProgressBar",
      progressText:      "#progressText",
    };

    this.$elements = {};
    Object.keys(this.selectors).forEach(key => {
      this.$elements[key] = $(this.selectors[key]);
    });

    this._cachedDueDate  = null;
    this._lastStartDate  = null;
    this._lastYears      = null;
  }

  initialize() {
    this.updateSalaryLoanVisibility();
    this.updateDueDate();
    this.calculateAmortization();
    this.calculateBalance();
    this.attachEventListeners();
  }

  updateSalaryLoanVisibility() {
    const loanValue    = parseFloat(DOMUtils.getValue(this.selectors.loan));
    const paymentValue = DOMUtils.getValue(this.selectors.payment);

    if (loanValue > 0) {
      DOMUtils.toggleElement(".sl", true, true);
    } else {
      DOMUtils.toggleElement(".sl", false);
      DOMUtils.toggleElement(".sl1", false);
      this.updateProgressBar(0, 0, 0, 0);
      return;
    }

    if (paymentValue) {
      DOMUtils.toggleElement(".sl1", true, true);
      this.updatePaymentMethodVisibility(parseInt(paymentValue));
    } else {
      DOMUtils.toggleElement(".sl1", false);
      this.updateProgressBar(0, 0, 0, 0);
    }
  }

  updatePaymentMethodVisibility(paymentMethod) {
    switch (paymentMethod) {
      case PAYMENT_METHODS.MONTHLY:
        DOMUtils.toggleElement(".radio-btn", true, true);
        DOMUtils.toggleElement(".salary1", true, true);
        DOMUtils.toggleElement(".salary2", false);
        break;
      case PAYMENT_METHODS.SEMI_MONTHLY:
        DOMUtils.toggleElement(".radio-btn", false);
        DOMUtils.toggleElement(".salary1", false);
        DOMUtils.toggleElement(".salary2", true, true);
        break;
      case PAYMENT_METHODS.LUMP_SUM:
        DOMUtils.toggleElement(".radio-btn", false);
        DOMUtils.toggleElement(".salary1", false);
        DOMUtils.toggleElement(".salary2", false);
        break;
      default:
        DOMUtils.toggleElement(".radio-btn", false);
        DOMUtils.toggleElement(".salary1", false);
        DOMUtils.toggleElement(".salary2", false);
    }
  }

  calculateAmortization() {
    const bank          = DOMUtils.getValue(this.selectors.bank);
    const loanAmount    = parseFloat(DOMUtils.getValue(this.selectors.loan));
    const years         = parseFloat(DOMUtils.getValue(this.selectors.year));
    const paymentMethod = parseFloat(DOMUtils.getValue(this.selectors.payment));

    if (!loanAmount || !years || !paymentMethod) return;

    const totalMonths = years * 12;
    let numberOfPayments;

    if (paymentMethod !== PAYMENT_METHODS.LUMP_SUM) {
      numberOfPayments = totalMonths * paymentMethod;
    } else {
      numberOfPayments = totalMonths * 1;
    }

    let yearlyRate;
    if (years === 1) {
      yearlyRate = INTEREST_RATES.ONE_YEAR;
    } else if (years === 1.5) {
      yearlyRate = INTEREST_RATES.ONE_HALF_YEAR;
    } else if (years === 2) {
      yearlyRate = INTEREST_RATES.TWO_YEAR;
    } else {
      yearlyRate = INTEREST_RATES.ONE_YEAR * years;
    }

    const rate = yearlyRate / numberOfPayments;

    let amortization;
    if (bank === BANKS.BADA1) {
      amortization = (rate * loanAmount) / (1 - Math.pow(1 + rate, -numberOfPayments + 1));
    } else {
      amortization = (rate * loanAmount) / (1 - Math.pow(1 + rate, -numberOfPayments));
    }

    this.setAmortizationValues(paymentMethod, amortization);
  }

  setAmortizationValues(paymentMethod, amortization) {
    const fixedAmount = amortization.toFixed(2);

    if (paymentMethod === PAYMENT_METHODS.MONTHLY) {
      DOMUtils.setValue(this.selectors.amortization, fixedAmount);
    } else if (paymentMethod === PAYMENT_METHODS.SEMI_MONTHLY) {
      DOMUtils.setValue(this.selectors.amortizationFirst, fixedAmount);
      DOMUtils.setValue(this.selectors.amortizationLast, fixedAmount);
    } else if (paymentMethod === PAYMENT_METHODS.LUMP_SUM) {
      const halfAmortization = (amortization / 2).toFixed(2);
      DOMUtils.setValue(this.selectors.amortization, fixedAmount);
      DOMUtils.setValue(this.selectors.amortizationFirst, halfAmortization);
      DOMUtils.setValue(this.selectors.amortizationLast, halfAmortization);
    }
  }

  calculateBalance() {
    const initialBalance = parseFloat(DOMUtils.getValue(this.selectors.loan));
    const paymentMethod  = parseInt(DOMUtils.getValue(this.selectors.payment));
    const startDateStr   = DOMUtils.getValue(this.selectors.date);
    const years          = parseFloat(DOMUtils.getValue(this.selectors.year));

    if (!initialBalance || !paymentMethod || !startDateStr) {
      this.updateProgressBar(0, 0, 0, 0);
      return;
    }

    let amortization;
    if (paymentMethod === PAYMENT_METHODS.MONTHLY || paymentMethod === PAYMENT_METHODS.LUMP_SUM) {
      amortization = parseFloat(DOMUtils.getValue(this.selectors.amortization));
    } else {
      const amortFirst = parseFloat(DOMUtils.getValue(this.selectors.amortizationFirst));
      const amortLast  = parseFloat(DOMUtils.getValue(this.selectors.amortizationLast));
      amortization = (amortFirst || 0) + (amortLast || 0);
    }

    const currentDate = new Date();
    const startDate   = DateUtils.parseFlexibleDate(startDateStr);

    if (!startDate) {
      this.updateProgressBar(0, 0, 0, 0);
      return;
    }

    const dueDateStrField = DOMUtils.getValue(this.selectors.dueDate);
    let dueDate = DateUtils.parseFlexibleDate(dueDateStrField);

    if (!dueDate && years) {
      dueDate = DateUtils.addYears(startDateStr, years);
    }

    let monthsPassed = DateUtils.getMonthsDifference(startDate, currentDate);

    if (dueDate) {
      const totalMonths = DateUtils.getMonthsDifference(startDate, dueDate);
      if (totalMonths >= 0) {
        monthsPassed = Math.min(monthsPassed, totalMonths);
      }
    }

    let cutoffsPassed = monthsPassed;
    if (paymentMethod === PAYMENT_METHODS.SEMI_MONTHLY) {
      cutoffsPassed = this.countCutoffs(startDate, currentDate);
      if (dueDate) {
        const totalCutoffs = this.countCutoffs(startDate, dueDate);
        cutoffsPassed = Math.min(cutoffsPassed, totalCutoffs);
      }
    }

    const result = this.calculateBalanceByPaymentMethod(
      initialBalance,
      amortization,
      monthsPassed,
      paymentMethod,
      cutoffsPassed
    );

    if (dueDate && currentDate >= dueDate) {
      result.balance   = 0;
      result.interest  = 0;
      result.principal = 0;
    }

    if (result.balance != null && !isNaN(result.balance) && Math.abs(result.balance) <= 0.11) {
      result.balance   = 0;
      result.interest  = 0;
      result.principal = 0;
    }

    if (result.balance != null && !isNaN(result.balance) && result.balance < 0) {
      result.balance   = 0;
      result.interest  = 0;
      result.principal = 0;
    }

    DOMUtils.setValue(this.selectors.balance,   result.balance.toFixed(2));
    DOMUtils.setValue(this.selectors.interest,  result.interest.toFixed(2));
    DOMUtils.setValue(this.selectors.principal, result.principal.toFixed(2));

    this.refreshProgressUI(initialBalance, result.balance, startDate, dueDate, paymentMethod, monthsPassed, currentDate);
  }

  calculateBalanceByPaymentMethod(initialBalance, amortization, months, paymentMethod, cutoffsPassed) {
    let currentBalance = initialBalance;
    let interest  = 0;
    let principal = 0;

    if (paymentMethod === PAYMENT_METHODS.MONTHLY || paymentMethod === PAYMENT_METHODS.LUMP_SUM) {
      for (let i = 0; i < months; i++) {
        interest       = currentBalance * INTEREST_RATES.MONTHLY_RATE;
        principal      = amortization - interest;
        currentBalance = currentBalance - principal;
        if (currentBalance < 0) { currentBalance = 0; break; }
      }
      interest       = parseFloat(interest.toFixed(2));
      principal      = parseFloat(principal.toFixed(2));
      currentBalance = parseFloat(currentBalance.toFixed(2));

    } else if (paymentMethod === PAYMENT_METHODS.SEMI_MONTHLY) {
      const halfMonthRate         = INTEREST_RATES.MONTHLY_RATE / 2;
      const halfMonthAmortization = amortization / 2;

      for (let i = 0; i < cutoffsPassed; i++) {
        interest       = currentBalance * halfMonthRate;
        principal      = halfMonthAmortization - interest;
        currentBalance = currentBalance - principal;
        if (currentBalance < 0) { currentBalance = 0; break; }
      }
      interest       = parseFloat(interest.toFixed(2));
      principal      = parseFloat(principal.toFixed(2));
      currentBalance = parseFloat(currentBalance.toFixed(2));
    }

    return { balance: currentBalance, interest, principal };
  }

  updateDueDate() {
    const startDateStr = DOMUtils.getValue(this.selectors.date);
    const years        = parseFloat(DOMUtils.getValue(this.selectors.year));

    if (!startDateStr || !years) return;

    if (this._lastStartDate === startDateStr && this._lastYears === years && this._cachedDueDate) {
      const dueDate = this._cachedDueDate;
      const yyyy = dueDate.getFullYear();
      const mm   = String(dueDate.getMonth() + 1).padStart(2, "0");
      const dd   = String(dueDate.getDate()).padStart(2, "0");
      DOMUtils.setValue(this.selectors.dueDate, `${yyyy}-${mm}-${dd}`);
      return;
    }

    const dueDate = DateUtils.addYears(startDateStr, years);
    if (!dueDate) return;

    this._cachedDueDate = dueDate;
    this._lastStartDate = startDateStr;
    this._lastYears     = years;

    const yyyy = dueDate.getFullYear();
    const mm   = String(dueDate.getMonth() + 1).padStart(2, "0");
    const dd   = String(dueDate.getDate()).padStart(2, "0");
    DOMUtils.setValue(this.selectors.dueDate, `${yyyy}-${mm}-${dd}`);
  }

  countCutoffs(fromDate, toDate) {
    if (!fromDate || !toDate || toDate <= fromDate) return 0;
    let count = 0;
    let d = new Date(fromDate.getFullYear(), fromDate.getMonth(), 1);
    while (d <= toDate) {
      const year    = d.getFullYear();
      const month   = d.getMonth();
      const fifteenth = new Date(year, month, 15);
      const lastDay   = new Date(year, month + 1, 0);
      if (fifteenth > fromDate && fifteenth <= toDate) count++;
      if (lastDay   > fromDate && lastDay   <= toDate) count++;
      d.setMonth(d.getMonth() + 1);
    }
    return count;
  }

  refreshProgressUI(initialLoan, currentBalance, startDate, dueDate, paymentMethod, monthsPassed, currentDate) {
    let totalPayments = 0;
    let paymentsMade  = 0;

    if (paymentMethod === PAYMENT_METHODS.SEMI_MONTHLY) {
      totalPayments = dueDate    ? this.countCutoffs(startDate, dueDate)      : monthsPassed * 2;
      paymentsMade  = currentDate ? this.countCutoffs(startDate, currentDate) : monthsPassed * 2;
    } else if (paymentMethod === PAYMENT_METHODS.MONTHLY) {
      totalPayments = dueDate ? DateUtils.getMonthsDifference(startDate, dueDate) : monthsPassed;
      paymentsMade  = monthsPassed;
    } else {
      totalPayments = 1;
      paymentsMade  = monthsPassed > 0 ? 1 : 0;
    }

    if (totalPayments > 0) paymentsMade = Math.min(paymentsMade, totalPayments);

    const paidAmount = Math.max(0, (initialLoan || 0) - (currentBalance || 0));
    const percent    = initialLoan > 0 ? Math.min(100, Math.max(0, (paidAmount / initialLoan) * 100)) : 0;

    this.updateProgressBar(percent, paymentsMade, totalPayments, currentBalance);
  }

  updateProgressBar(percent, paymentsMade, totalPayments, currentBalance) {
    const bar = $(this.selectors.progressBar);
    const txt = $(this.selectors.progressText);
    if (!bar.length || !txt.length) return;

    const p = isFinite(percent) ? percent : 0;
    bar.css("width", `${p.toFixed(0)}%`);
    bar.text(`${p.toFixed(0)}%`);

    const made  = Number.isFinite(paymentsMade)  ? paymentsMade  : 0;
    const total = Number.isFinite(totalPayments) ? totalPayments : 0;
    txt.text(`${made} of ${total} payments made`);
  }

  attachEventListeners() {
    const debouncedCalculation = debounce(() => {
      this.updateSalaryLoanVisibility();
      this.calculateAmortization();
      this.calculateBalance();
    }, 300);

    $(this.selectors.loan).on("keyup", debouncedCalculation);
    $(this.selectors.loan).on("change", () => {
      this.updateSalaryLoanVisibility();
      this.calculateAmortization();
      this.calculateBalance();
    });

    $(this.selectors.bank).on("change", () => {
      this.calculateAmortization();
      this.calculateBalance();
    });

    $(this.selectors.payment).on("change", () => {
      this.updateSalaryLoanVisibility();
      this.calculateAmortization();
      this.calculateBalance();
    });

    const debouncedYearCalculation = debounce(() => {
      this.updateDueDate();
      this.calculateAmortization();
      this.calculateBalance();
    }, 300);

    $(this.selectors.year).on("keyup", debouncedYearCalculation);
    $(this.selectors.year).on("change", () => {
      this.updateDueDate();
      this.calculateAmortization();
      this.calculateBalance();
    });

    $(this.selectors.date).on("change", () => {
      this.updateDueDate();
      this.calculateBalance();
    });

    const debouncedBalanceCalculation = debounce(() => {
      this.calculateBalance();
    }, 300);

    $(this.selectors.amortization).on("keyup", debouncedBalanceCalculation);
    $(this.selectors.amortization).on("change", () => this.calculateBalance());

    $(this.selectors.amortizationFirst).on("keyup", debouncedBalanceCalculation);
    $(this.selectors.amortizationFirst).on("change", () => this.calculateBalance());

    $(this.selectors.amortizationLast).on("keyup", debouncedBalanceCalculation);
    $(this.selectors.amortizationLast).on("change", () => this.calculateBalance());

    $(this.selectors.dueDate).on("change", () => this.calculateBalance());
  }
} // end SalaryLoanCalculator

// ─────────────────────────────────────────────
// Government Contributions Calculator
// ─────────────────────────────────────────────
class GovernmentContributionsCalculator {
  constructor() {
    this.sssTable    = this.initializeSSSTables();
    this.taxBrackets = this.initializeTaxBrackets();
  }

  initializeSSSTables()  { return window.__SSS_TABLES__; }
  initializeTaxBrackets() { return window.__TAX_BRACKETS__; }

  findInTable(table, monthlyRate) {
    return table.find(b => monthlyRate >= b.min && monthlyRate <= b.max);
  }

  calculateSSS(monthlyRate) {
    const employeeBracket = this.findInTable(this.sssTable.employee, monthlyRate);
    const employerBracket = this.findInTable(this.sssTable.employer, monthlyRate);
    const employeeContribution = employeeBracket ? employeeBracket.amount : 0;
    let employerContribution   = employerBracket ? employerBracket.amount : 0;
    if (employerBracket) employerContribution += employerBracket.ecBonus;
    return { employee: employeeContribution, employer: employerContribution };
  }

  calculateSSSMandatory(monthlyRate) {
    const bracket = this.findInTable(this.sssTable.mandatory, monthlyRate);
    return bracket
      ? { employee: bracket.employee, employer: bracket.employer }
      : { employee: 0, employer: 0 };
  }

  calculateTax(monthlyRate) {
    const bracket = this.findInTable(this.taxBrackets, monthlyRate);
    if (!bracket) return 0;
    const excess = monthlyRate - bracket.excess;
    return bracket.base + (excess * bracket.rate);
  }

  calculatePhilHealth(monthlyRate) {
    const contribution = (monthlyRate * 0.05) / 2;
    return { employee: contribution, employer: contribution };
  }

  calculatePagibig() {
    return { employee: 200, employer: 200 };
  }

  updateAllContributions(monthlyRate) {
    const sss = this.calculateSSS(monthlyRate);
    DOMUtils.setValue("#sss",         sss.employee.toFixed(2));
    DOMUtils.setValue("#sssEmployer", sss.employer.toFixed(2));

    const sssMandatory = this.calculateSSSMandatory(monthlyRate);
    DOMUtils.setValue("#sssmand",         sssMandatory.employee.toFixed(2));
    DOMUtils.setValue("#sssmandEmployer", sssMandatory.employer.toFixed(2));

    const tax = this.calculateTax(monthlyRate);
    DOMUtils.setValue("#tax", tax.toFixed(2));

    const philHealth = this.calculatePhilHealth(monthlyRate);
    DOMUtils.setValue("#philhealth",         philHealth.employee.toFixed(2));
    DOMUtils.setValue("#philhealthEmployer", philHealth.employer.toFixed(2));

    const pagibig = this.calculatePagibig();
    DOMUtils.setValue("#pagibig",         pagibig.employee.toFixed(2));
    DOMUtils.setValue("#pagibigEmployer", pagibig.employer.toFixed(2));
  }
} // end GovernmentContributionsCalculator

// ─────────────────────────────────────────────
// Main init
// ─────────────────────────────────────────────
$(document).ready(function () {
  window.__SSS_TABLES__   = window.__SSS_TABLES__   || { employee: [], employer: [], mandatory: [] };
  window.__TAX_BRACKETS__ = window.__TAX_BRACKETS__ || [];

  const salaryLoanCalc = new SalaryLoanCalculator();
  salaryLoanCalc.initialize();

  const govContribCalc = new GovernmentContributionsCalculator();

  const debouncedContribCalculation = debounce(function () {
    const monthlyRate = parseFloat($(this).val());
    if (monthlyRate) govContribCalc.updateAllContributions(monthlyRate);
  }, 300);

  $("#monthlyrate").on("keyup", debouncedContribCalculation);
  $("#monthlyrate").on("change", function () {
    const monthlyRate = parseFloat($(this).val());
    if (monthlyRate) govContribCalc.updateAllContributions(monthlyRate);
  });

  const loanManagers = [
    new LoanPaymentManager({
        paymentSelector: "#sssloanPayment",
        containerClass:  LOAN_TYPES.SSS_LOAN,
        option1Class:    "sssloan1",
        option2Class:    "sssloan2",
        radioClass:      "sssloanRadio",
        dateSelector:    "#sssloanDate",
        cutoffName:      "sssloanCutoffSelect",  // ← name ng radio, hindi id
    }),
    new LoanPaymentManager({
        paymentSelector: "#ssscalamityPayment",
        containerClass:  LOAN_TYPES.SSS_CALAMITY,
        option1Class:    "ssscalamity1",
        option2Class:    "ssscalamity2",
        radioClass:      "ssscalamityRadio",
        dateSelector:    "#ssscalamityDate",
        cutoffName:      "ssscalamityCutoffSelect",
    }),
    new LoanPaymentManager({
        paymentSelector: "#pagibigloanPayment",
        containerClass:  LOAN_TYPES.PAGIBIG_LOAN,
        option1Class:    "pagibigloan1",
        option2Class:    "pagibigloan2",
        radioClass:      "pagibigloanRadio",
        dateSelector:    "#pagibigloanDate",
        cutoffName:      "pagibigloanCutoffSelect",
    }),
    new LoanPaymentManager({
        paymentSelector: "#pagibigcalamityPayment",
        containerClass:  LOAN_TYPES.PAGIBIG_CALAMITY,
        option1Class:    "pagibigcalamity1",
        option2Class:    "pagibigcalamity2",
        radioClass:      "pagibigcalamityRadio",
        dateSelector:    "#pagibigcalamityDate",
        cutoffName:      "pagibigcalamityCutoffSelect",
    }),
  ];

  loanManagers.forEach((m) => m.initialize());

  window.getslBalance = function () {
    salaryLoanCalc.calculateBalance();
  };
});