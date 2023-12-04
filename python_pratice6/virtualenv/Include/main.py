
from .app.Calculator import Calculator




def main():
    calc = Calculator(5, 2)

 
    result_add = calc.add()
    result_subtract = calc.subtract()
    result_divide = calc.divide()
    result_multiply= calc.multiply()
  
    print("Result of addition:", result_add)
    print("Result of subtraction:", result_subtract)
    print("Result of multiply:", result_multiply)
    print("Result of divide:", result_divide)

if __name__ == "__main__":
    main()