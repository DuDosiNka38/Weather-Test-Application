
from .app.Calculator import Calculator

def main():
    calc = Calculator(5, 2)

 
    result_add = calc.add()
    
    result_subtract = calc.subtract()
    
    result_divide = calc.divide()
    
    result_multiply= calc.multiply()
    
    result_generate_random_number= calc.generate_random_number()
  
    print("Result of addition:", result_add)
    
    print("Result of subtraction:", result_subtract)
    
    print("Result of multiply:", result_multiply)
    
    print("Result of divide:", result_divide)
    
    print("Result of generate_random_number:", result_generate_random_number)

if __name__ == "__main__":
    main()