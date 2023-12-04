import math
import random

class Calculator:
    def __init__(self, num, num2):
        self.num = num
        self.num2 = num2

    def add(self):
        return self.num + self.num2

    def subtract(self):
        return self.num - self.num2

    def multiply(self):
        return self.num * self.num2

    def divide(self):
        if self.operand2 != 0:
            return self.num / self.num2
        else:
            return "Cannot divide by zero."

    def power(self):
        return math.pow(self.num, self.num2)

    @staticmethod
    def generate_random_number(a, b):
        return random.uniform(a, b)  

    